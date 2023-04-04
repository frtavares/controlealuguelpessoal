<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Client, App\Http\Models\Rent, App\Http\Models\Ano, App\Http\Models\Mes, App\Http\Models\Pendencias;

use Validator, Str, Config, Image, Auth, PDF, DateTime, DB;
use Yajra\Datatables\Facades\Datatables;

class RentController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function generate_unique_code($table = NULL, $type_of_code = NULL, $size_of_code, $field_search) {

        do {
            $code = random_string($type_of_code, $size_of_code);
            $this->db->where($field_search, $code);
            $this->db->from($table);
        } while ($this->db->count_all_results() >= 1);

        return $code;
    }

    public function getHome($status){
        switch ($status) {
            case '0':
                $rents = Rent::with(['clis', 'anoss', 'mesess'])->where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $rents = Rent::with(['clis', 'anoss', 'mesess'])->where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $rents = Rent::with(['clis', 'anoss', 'mesess'])->orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $rents = Rent::with(['clis', 'anoss', 'mesess'])->onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['rents' => $rents];
      
        return view('admin.rents.home', $data);
    }

    public function getRentAdd(){

        
        $clis   = Client::where('status', '1')->pluck('name', 'id');
        $anoss   = Ano::where('status', '1')->pluck('ano', 'id');
        $mesess   = Mes::where('status', '1')->pluck('mes', 'id');
       
       

        $data = [
                   
                   
                    'clis'      => $clis,
                    'anoss'     => $anoss,
                    'mesess'    => $mesess
                   
                ];

        return view('admin.rents.add', $data);

    }

    public function postRentAdd(Request $request){
        $rules = [
            'vencimento'       => 'required',
            'client'       => 'required',
        ];

        $messages = [

            'vencimento.required'   => 'O campo vencimento não pode ficar vazio!',
            'client.required'   => 'O campo locador não pode ficar vazio!',

        ];


        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:

            $rent = new Rent;
           
            $rent->status                   = '1';
            $rent->code                     = substr(uniqid(rand()), 0, 11);
            $rent->client_id                = e($request->input('client'));
            $rent->mes_id                   = e($request->input('mes'));
            $rent->vencimento               = $request->input('vencimento');
            $rent->ano_id                   = date('Y');
            // $rent->ano_id                   = e($request->input('ano'));
            $rent->valor                    = $request->input('valor');
            $rent->desconto                 = $request->input('desconto');
            $rent->referenciadesconto       = Str::upper(e($request->input('referenciadesconto')));
            $rent->condominio               = $request->input('condominio');
            $rent->referenciacondominio     = Str::upper(e($request->input('referenciacondominio')));
            $rent->taxaextra                = $request->input('taxaextra');
            $rent->referenciataxa           = Str::upper(e($request->input('referenciataxa')));
            $rent->taxaincendio             = $request->input('taxaincendio');
            $rent->referenciataxaincendio   = Str::upper(e($request->input('referenciataxaincendio')));
            $rent->iptu                     = $request->input('iptu');
            $rent->referenciaiptu           = Str::upper(e($request->input('referenciaiptu')));
            $rent->seguro                   = $request->input('seguro');
            $rent->total                    = $request->input('total');
            $rent->subtotal                 = $request->input('subtotal');
            $rent->observacoes              = Str::upper(e($request->input('observacoes')));
            $rent->slug                     = Str::slug($request->input('referencia'));
            $rent->userlog                  = e($request->input('userlog'));
            //$rent->pendencia_id             = e($request->input('referencia'));

             if ($rent->save()):
                return back()->with('message', 'Registro cadastrado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getRentEdit($id){

        $r      = Rent::findOrFail($id);
        $clis   = Client::where('status', '1')->pluck('name', 'id');
        $anoss   = Ano::where('status', '1')->pluck('ano', 'id');
        $mesess   = Mes::where('status', '1')->pluck('mes', 'id');
        

       
        $data = [

                    
                    'clis' => $clis,
                    'anoss' => $anoss,
                    'mesess' => $mesess,
                   
                    'r' => $r
                ];


        return view('admin.rents.edit', $data);
    }

    public function postRentEdit($id, Request $request){
        $rules = [
            'vencimento'       => 'required',
            
        ];

        $messages = [

            'vencimento.required'   => 'O campo vencimento não pode ficar vazio!',
           

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('error', 'Houve um erro!')->with('typealert', 'error')->withInput();
        else:

            $rent                           = Rent::findOrFail($id);

            $rent->status                   = '1';
            $rent->code                     = substr(uniqid(rand()), 0, 11);
            $rent->client_id                = e($request->input('client'));
            $rent->mes_id                   = e($request->input('mes'));
            $rent->vencimento               = $request->input('vencimento');
            $rent->ano_id                   = date('Y');
            // $rent->ano_id                   = e($request->input('ano'));
            $rent->valor                    = $request->input('valor');
            $rent->desconto                 = $request->input('desconto');
            $rent->referenciadesconto       = Str::upper(e($request->input('referenciadesconto')));
            $rent->condominio               = $request->input('condominio');
            $rent->referenciacondominio     = Str::upper(e($request->input('referenciacondominio')));
            $rent->taxaextra                = $request->input('taxaextra');
            $rent->referenciataxa           = Str::upper(e($request->input('referenciataxa')));
            $rent->taxaincendio             = $request->input('taxaincendio');
            $rent->referenciataxaincendio   = Str::upper(e($request->input('referenciataxaincendio')));
            $rent->iptu                     = $request->input('iptu');
            $rent->referenciaiptu           = Str::upper(e($request->input('referenciaiptu')));
            $rent->seguro                   = $request->input('seguro');
            $rent->total                    = $request->input('total');
            $rent->subtotal                 = $request->input('subtotal');
            $rent->observacoes              = Str::upper(e($request->input('observacoes')));
            $rent->slug                     = Str::slug($request->input('referencia'));
            $rent->userlog                  = e($request->input('userlog'));
            //$rent->pendencia_id               = e($request->input('referencia'));

            if($rent->save()):

                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');
            endif;
        endif;
    }


    public function postRentSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'O campo consulta é requerido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/rents/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $rents = Rent::where('code', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $rents = Rent::where('booking', $request->input('search'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['rents' => $rents];
        return view('admin.rents.search', $data);
        endif;
    }

    public function getRentDelete($id){
         $r = Rent::findOrFail($id);
         if($r->delete()):
            return redirect('/admin/rents/1')->with('message', 'Registro enviado para lixeira!')->with('typealert', 'info');
        endif;
    }
    public function getRentRestore($id){
         $r = Rent::onlyTrashed()->where('id', $id)->first();
         if($r->restore()):
            return redirect('/admin/rent/'.$r->id.'/edit')->with('message', 'O registro selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


    public function getRentPdf($id=null){


    $r = Rent::findOrFail($id);
    $rents = Rent::where('code', 'id');
    $data = ['rents' => $rents, 'r' => $r];

    $pdf = PDF::loadView('admin.rents.pdf', compact('r'))->setOptions(['defaultFont' => 'sans-serif']);
    return $pdf->setPaper('a4')->stream('admin.rents.pdf', $data);
    // return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.rents.pdf', compact('p'))->stream('admin.rents.pdf', $data);


        // $p = Rent::findOrFail($id);
        // $rents = Rent::where('code', 'id');
        // $data = ['rents' => $rents, 'p' => $p];
        // $pdf = PDF::loadView('admin.rents.pdf', compact('p'))->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->setPaper('a4')->stream('admin.rents.pdf', $data);





        //  $p = Rent::findOrFail($id);
        //  $rents = Rent::where('code', 'id');
        //  $data = ['rents' => $rents, 'p' => $p];
        //  return view('admin.rents.pdf', $data);


    }



}

