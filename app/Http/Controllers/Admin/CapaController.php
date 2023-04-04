<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Capa, App\Http\Models\Ship, App\Http\Models\Client, App\Http\Models\Pessoa, App\Http\Models\Transportadora, App\Http\Models\Iso;

use Validator, Str, Config, Image, Auth, PDF, DateTime, DB;
use Dompdf\Dompdf;
use Carbon\Carbon;

class CapaController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($status){
        switch ($status) {
            case '0':
                $capas = Capa::with(['ships','clis','pess','trans','isoss'])->where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $capas = Capa::with(['ships','clis','pess','trans','isoss'])->where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $capas = Capa::with(['ships','clis','pess','trans','isoss'])->orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $capas = Capa::with(['ships','clis','pess','trans','isoss'])->onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['capas' => $capas];
        return view('admin.capas.home', $data);
    }

    public function getCapaAdd(){

        $isoss  = Iso::where('status', '1')->pluck('name', 'id');
        $ships  = Ship::where('status', '1')->pluck('name', 'id');
        $clis   = Client::where('status', '1')->pluck('namecnpj', 'id');
        $pess   = Pessoa::where('status', '1')->pluck('namecpf', 'id');
        $trans  = Transportadora::where('status', '1')->pluck('namecnpj', 'id');

        $data = [
                    'isoss' => $isoss,
                    'ships' => $ships,
                    'clis' => $clis,
                    'pess' => $pess,
                    'trans' => $trans
                ];

        return view('admin.capas.add', $data);

    }

    public function postCapaAdd(Request $request){
        $rules = [
            'dataservico'       => 'required',
            'tara'              => 'required',
            //'booking'         => 'required',
            'pessoa'            => 'required',
            'transportadora'    => 'required',
            'iso'               => 'required',
            //'ship'            => 'required',
            'client'            => 'required',
            //'code'            => 'required|unique:capas',
        ];

        $messages = [

            'dataservico.required'   => 'O campo data não pode ficar vazio!',
            'tara.required'          => 'É necessario informar a tara para calcular!',
           // 'booking.required'     => 'Escolha um booking!',
            'pessoa.required'        => 'Escolha um motorista!',
            'transportadora.required'=> 'Escolha uma transportadora!',
            'iso.required'           => 'Escolha um Tipo/ISO!',
            //'ship.required'        => 'Escolha um navio!',
            'client.required'        => 'Escolha um cliente/exportador!',
           // 'code.unique'           => 'Já existe este container no banco de dados!'

        ];


        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:

            $capa = new Capa;
            $capa->status           = '1';
           // $capa->dataservico    =   Carbon::createFromFormat('d-m-Y', $capa->dataservico)->format('Y-m-d');
            $capa->dataservico      = e($request->input('dataservico'));
            $capa->code             = Str::upper(e($request->input('code')));
            $capa->client_id        = e($request->input('client'));
            $capa->booking          = Str::upper(e($request->input('booking')));
            $capa->transportadora_id = e($request->input('transportadora'));
            $capa->pessoa_id        = e($request->input('pessoa'));
            $capa->ship_id          = e($request->input('ship'));
            //$capa->navio            = Str::upper(e($request->input('navio')));
            $capa->tara             = e($request->input('tara'));
            $capa->iso_id           = e($request->input('iso'));
            $capa->lacre            = Str::upper(e($request->input('lacre')));
            $capa->lacre2           = Str::upper(e($request->input('lacre2')));
            $capa->danfe            = e($request->input('danfe'));
            $capa->placa           = Str::upper(e($request->input('placa')));
            $capa->placa2           = Str::upper(e($request->input('placa2')));
            $capa->pesoentrada      = e($request->input('pesoentrada'));
            $capa->pesovazio        = e($request->input('pesovazio'));
            $capa->pesocarga        = e($request->input('pesocarga'));
            $capa->pesobruto        = e($request->input('pesobruto'));
            $capa->carga            = Str::upper(e($request->input('carga')));
            $capa->slug             = Str::slug($request->input('code'));
            $capa->userlog          = e($request->input('userlog'));
            $capa->cnpj             = Str::upper(e($request->input('cnpj')));

             if ($capa->save()):
                return back()->with('message', 'Registro cadastrado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getCapaEdit($id){
        $p = Capa::findOrFail($id);

        $isoss          = Iso::where('status', '1')->pluck('name', 'id');
        $ships          = Ship::where('status', '1')->pluck('name', 'id');
        $clis           = Client::where('status', '1')->pluck('namecnpj', 'id');
        $pess           = Pessoa::where('status', '1')->pluck('namecpf', 'id');
        $trans          = Transportadora::where('status', '1')->pluck('namecnpj', 'id');

        $data = [

                    'isoss' => $isoss,
                    'ships' => $ships,
                    'clis' => $clis,
                    'pess' => $pess,
                    'trans' => $trans,
                    'p' => $p
                ];


        return view('admin.capas.edit', $data);
    }

    public function postCapaEdit($id, Request $request){
        $rules = [
           // 'code'            => 'required',
            'client'            => 'required',
           // 'booking'         => 'required',
            //'ship'            => 'required',
            'pessoa'            => 'required',
            'transportadora'    => 'required',
            'iso'               => 'required',
            'tara'              => 'required',
            //'code'            => 'required|unique:capas',
        ];

        $messages = [

          //  'code.required'  => 'O campo container não pode ficar vazio!',
            'tara.required'    => 'É necessario informar a tara para calcular!',
            //'code.unique'    => 'Já existe este container no banco de dados!'


        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:

            $capa                   = Capa::findOrFail($id);

            $capa->status           = '1';
            $capa->dataservico      = e($request->input('dataservico'));
           // $capa->dataservico    =   Carbon::createFromFormat('d-m-Y', $capa->dataservico)->format('Y-m-d');
            //$capa->dataservico    =   date('Y-m-d', strtotime($capa['dataservico']));
            $capa->code             = Str::upper(e($request->input('code')));

            $capa->client_id        = e($request->input('client'));
            $capa->booking          = Str::upper(e($request->input('booking')));
            $capa->transportadora_id = e($request->input('transportadora'));
            $capa->pessoa_id        = e($request->input('pessoa'));
            $capa->ship_id          = e($request->input('ship'));
            //$capa->navio            = Str::upper(e($request->input('navio')));
            $capa->tara             = e($request->input('tara'));
            $capa->iso_id           = e($request->input('iso'));
            $capa->lacre            = Str::upper(e($request->input('lacre')));
            $capa->lacre2           = Str::upper(e($request->input('lacre2')));
            $capa->danfe            = e($request->input('danfe'));
            $capa->cnpj             = e($request->input('cnpj'));
            $capa->placa            = Str::upper(e($request->input('placa')));
            $capa->placa2           = Str::upper(e($request->input('placa2')));

            $capa->pesoentrada      = e($request->input('pesoentrada'));
            $capa->pesovazio        = e($request->input('pesovazio'));
            $capa->pesocarga        = e($request->input('pesocarga'));
            $capa->pesobruto        = e($request->input('pesobruto'));
            $capa->pesobruto        = e($request->input('pesobruto'));
            $capa->carga            = Str::upper(e($request->input('carga')));


            $capa->slug             = Str::slug($request->input('code'));
            $capa->userlog          = e($request->input('userlog'));

            if($capa->save()):

                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');
            endif;
        endif;
    }


    public function postCapaSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'O campo consulta é requerido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/capas/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $capas = Capa::where('code', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $capas = Capa::where('booking', $request->input('search'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['capas' => $capas];
        return view('admin.capas.search', $data);
        endif;
    }

    public function getCapaDelete($id){
         $p = Capa::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/capas/1')->with('message', 'Produto enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getCapaRestore($id){
         $p = Capa::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/capa/'.$p->id.'/edit')->with('message', 'O produto selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


    public function getCapaPdf($id=null){


    $p = Capa::findOrFail($id);
    $capas = Capa::where('code', 'id');
    $data = ['capas' => $capas, 'p' => $p];

    $pdf = PDF::loadView('admin.capas.pdf', compact('p'))->setOptions(['defaultFont' => 'sans-serif']);
    return $pdf->setPaper('a4')->stream('admin.capas.pdf', $data);
    // return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.capas.pdf', compact('p'))->stream('admin.capas.pdf', $data);


        // $p = Capa::findOrFail($id);
        // $capas = Capa::where('code', 'id');
        // $data = ['capas' => $capas, 'p' => $p];
        // $pdf = PDF::loadView('admin.capas.pdf', compact('p'))->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->setPaper('a4')->stream('admin.capas.pdf', $data);





        //  $p = Capa::findOrFail($id);
        //  $capas = Capa::where('code', 'id');
        //  $data = ['capas' => $capas, 'p' => $p];
        //  return view('admin.capas.pdf', $data);


    }


}
