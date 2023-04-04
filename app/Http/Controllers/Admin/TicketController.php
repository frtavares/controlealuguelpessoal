<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Ticket, App\Http\Models\Ship, App\Http\Models\Client, App\Http\Models\Pessoa, App\Http\Models\Transportadora, App\Http\Models\TipoCarga;

use Validator, Str, Config, Image, Auth, PDF, DateTime, DB;
use Dompdf\Dompdf;
use Carbon\Carbon;

class TicketController extends Controller
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
                $tickets = Ticket::with(['ships','clis','pess','trans','tcargas'])->where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $tickets = Ticket::with(['ships','clis','pess','trans','tcargas'])->where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $tickets = Ticket::with(['ships','clis','pess','trans','tcargas'])->orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $tickets = Ticket::with(['ships','clis','pess','trans','tcargas'])->onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['tickets' => $tickets];
        return view('admin.tickets.home', $data);
    }

    public function getTicketAdd(){

        $tcargas  = TipoCarga::where('status', '1')->pluck('name', 'id');
        $ships  = Ship::where('status', '1')->pluck('name', 'id');
        $clis   = Client::where('status', '1')->pluck('namecnpj', 'id');
        $pess   = Pessoa::where('status', '1')->pluck('namecpf', 'id');
        $trans  = Transportadora::where('status', '1')->pluck('namecnpj', 'id');
       
        $data = [   
                    'tcargas' => $tcargas,
                    'ships' => $ships,
                    'clis' => $clis,
                    'pess' => $pess,
                    'trans' => $trans
                ];

        return view('admin.tickets.add', $data);

    }

    public function postTicketAdd(Request $request){
        $rules = [
            'dataservico'       => 'required',
            'tara'              => 'required',
            //'booking'         => 'required',
            'pessoa'            => 'required',
            'transportadora'    => 'required',
            'tipocarga'               => 'required',
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
            'tipocarga.required'           => 'Escolha um Tipo/ISO!',
            //'ship.required'        => 'Escolha um navio!',
            'client.required'        => 'Escolha um cliente/exportador!',
           // 'code.unique'           => 'Já existe este container no banco de dados!'

        ];
        

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:
            
            $ticket = new Ticket;
            $ticket->status           = '1';
           // $capa->dataservico    =   Carbon::createFromFormat('d-m-Y', $capa->dataservico)->format('Y-m-d');
            $ticket->dataservico      = e($request->input('dataservico'));
            $ticket->code             = Str::upper(e($request->input('code')));
            $ticket->client_id        = e($request->input('client'));
            $ticket->booking          = Str::upper(e($request->input('booking')));
            $ticket->transportadora_id = e($request->input('transportadora'));
            $ticket->pessoa_id        = e($request->input('pessoa'));
            $ticket->ship_id          = e($request->input('ship'));
            $ticket->navio            = Str::upper(e($request->input('navio')));
            $ticket->tara             = e($request->input('tara'));
            $ticket->tipocarga_id           = e($request->input('tipocarga'));
            $ticket->lacre            = Str::upper(e($request->input('lacre')));
            $ticket->lacre2           = Str::upper(e($request->input('lacre2')));
            $ticket->danfe            = e($request->input('danfe'));
            $ticket->placa           = Str::upper(e($request->input('placa')));
            $ticket->placa2           = Str::upper(e($request->input('placa2')));
            $ticket->pesoentrada      = e($request->input('pesoentrada'));
            $ticket->pesovazio        = e($request->input('pesovazio'));
            $ticket->pesocarga        = e($request->input('pesocarga'));
            $ticket->pesobruto        = e($request->input('pesobruto'));
            $ticket->carga            = Str::upper(e($request->input('carga')));
            $ticket->slug             = Str::slug($request->input('code'));
            $ticket->userlog          = e($request->input('userlog'));
            $ticket->cnpj             = Str::upper(e($request->input('cnpj')));

             if ($ticket->save()):
                return back()->with('message', 'Registro cadastrado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getTicketEdit($id){
        $p = Ticket::findOrFail($id);
        
        $tcargas        = TipoCarga::where('status', '1')->pluck('name', 'id');
        $ships          = Ship::where('status', '1')->pluck('name', 'id');
        $clis           = Client::where('status', '1')->pluck('namecnpj', 'id');
        $pess           = Pessoa::where('status', '1')->pluck('namecpf', 'id');
        $trans          = Transportadora::where('status', '1')->pluck('namecnpj', 'id');

        $data = [
                    
                    'tcargas' => $tcargas,
                    'ships' => $ships,
                    'clis' => $clis,
                    'pess' => $pess,
                    'trans' => $trans,
                    'p' => $p
                ];
        
        
        return view('admin.tickets.edit', $data);
    }

    public function postTicketEdit($id, Request $request){
        $rules = [
           // 'code'            => 'required',
            'client'            => 'required',
           // 'booking'         => 'required',
            //'ship'            => 'required',
            'pessoa'            => 'required',
            'transportadora'    => 'required',
            'tipocarga'               => 'required',
            'tara'              => 'required',
            //'code'            => 'required|unique:tickets',
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

            $ticket                   = Ticket::findOrFail($id);
           
            $ticket->status           = '1';
           // $capa->dataservico    =   Carbon::createFromFormat('d-m-Y', $capa->dataservico)->format('Y-m-d');
            $ticket->dataservico      = e($request->input('dataservico'));
            $ticket->code             = Str::upper(e($request->input('code')));
            $ticket->client_id        = e($request->input('client'));
            $ticket->booking          = Str::upper(e($request->input('booking')));
            $ticket->transportadora_id = e($request->input('transportadora'));
            $ticket->pessoa_id        = e($request->input('pessoa'));
            $ticket->ship_id          = e($request->input('ship'));
            $ticket->navio            = Str::upper(e($request->input('navio')));
            $ticket->tara             = e($request->input('tara'));
            $ticket->tipocarga_id           = e($request->input('tipocarga'));
            $ticket->lacre            = Str::upper(e($request->input('lacre')));
            $ticket->lacre2           = Str::upper(e($request->input('lacre2')));
            $ticket->danfe            = e($request->input('danfe'));
            $ticket->placa           = Str::upper(e($request->input('placa')));
            $ticket->placa2           = Str::upper(e($request->input('placa2')));
            $ticket->pesoentrada      = e($request->input('pesoentrada'));
            $ticket->pesovazio        = e($request->input('pesovazio'));
            $ticket->pesocarga        = e($request->input('pesocarga'));
            $ticket->pesobruto        = e($request->input('pesobruto'));
            $ticket->carga            = Str::upper(e($request->input('carga')));
            $ticket->slug             = Str::slug($request->input('code'));
            $ticket->userlog          = e($request->input('userlog'));
            $ticket->cnpj             = Str::upper(e($request->input('cnpj')));

            if($ticket->save()):
                
                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');
            endif;
        endif;
    }

   
    public function postTicketSearch(Request $request){
        $rules = [
            // 'search' => 'required'
        ];

        $messages = [
            // 'search.required' => 'O campo consulta é requerido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/tickets/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $tickets = Ticket::where('dataservico', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                      $tickets = Ticket::where('client', '=', '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['tickets' => $tickets];
        return view('admin.tickets.search', $data);
        endif;
    }

    public function getTicketDelete($id){
         $p = Ticket::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/tickets/1')->with('message', 'Produto enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getTicketRestore($id){
         $p = Ticket::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/ticket/'.$p->id.'/edit')->with('message', 'O produto selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


    public function getTicketPdf($id=null){

       
    $p = Ticket::findOrFail($id);
    $tickets = Ticket::where('code', 'id');
    $data = ['tickets' => $tickets, 'p' => $p];
    
    $pdf = PDF::loadView('admin.tickets.pdf', compact('p'))->setOptions(['defaultFont' => 'sans-serif']); 
    return $pdf->setPaper('a4')->stream('admin.tickets.pdf', $data); 
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
