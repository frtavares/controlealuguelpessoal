<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Client;

use Validator, Str, Config, Image;

class ClientController extends Controller
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
                $clients = Client::where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $clients = Client::where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $clients = Client::orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $clients = Client::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['clients' => $clients];
        return view('admin.clients.home', $data);
    }

    public function getClientAdd(){

        $clients = Client::orderBy('name', 'Asc')->get();
        $data = ['clients' => $clients];

        return view('admin.clients.add', $data);
    }

    public function postClientAdd(Request $request){
        $rules = [
             'name'      => 'required',
            'fantasia'      => 'required',
            // 'cnpj'      => 'required|cnpj|unique:clients',
        ];

        $messages = [
             'name.required'    => 'O campo Razão Social não pode ficar vazio!',
            'fantasia.required'    => 'O campo fantasia não pode ficar vazio!',
            // 'cnpj.required'    => 'O campo CNPJ não pode ficar vazio!',
            // 'cnpj.unique'      => 'Já existe este CNPJ no banco de dados!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:
            $client = new Client;
            $client->name               = e($request->input('name'));
            $client->status             = '1';
            $client->valor                = e($request->input('valor'));
            $client->fantasia           = Str::upper(e($request->input('fantasia')));
            $client->cnpj               = e($request->input('cnpj'));
            $client->cep                = e($request->input('cep'));
            $client->logradouro         = e($request->input('logradouro'));
            $client->numero             = e($request->input('numero'));
            $client->complemento        = e($request->input('complemento'));
            $client->bairro             = e($request->input('bairro'));
            $client->municipio          = e($request->input('municipio'));
            $client->uf                 = e($request->input('uf'));
            $client->email              = e($request->input('email'));
            $client->slug               = Str::slug($request->input('name'));
            $client->namecnpj           = e($request->input('fantasia')) .'- CNPJ:'. e($request->input('cnpj'));

            if ($client->save()):

                return redirect('/admin/clients/'.$client->id. '/edit')->with('message', 'Gravado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getClientEdit($id){

        $p = Client::findOrFail($id);
        $clients = Client::where('name', 'id');
        $data = ['clients' => $clients, 'p' => $p];
        return view('admin.clients.edit', $data);

    }

    public function postClientEdit($id, Request $request){
        $rules = [
            'name'      => 'required',
            'fantasia'      => 'required',
        ];

        $messages = [

            'name.required'    => 'O campo Razão Social não pode ficar vazio!',
            'fantasia.required'    => 'O campo fantasia não pode ficar vazio!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:

            $client                 = Client::findOrFail($id);
            $client->name           = e($request->input('name'));
            $client->status         = '1';
            $client->valor          = e($request->input('valor'));
            $client->fantasia       = Str::upper(e($request->input('fantasia')));
            $client->cnpj           = e($request->input('cnpj'));
            $client->cep            = e($request->input('cep'));
            $client->logradouro     = e($request->input('logradouro'));
            $client->numero         = e($request->input('numero'));
            $client->complemento    = e($request->input('complemento'));
            $client->bairro         = e($request->input('bairro'));
            $client->municipio      = e($request->input('municipio'));
            $client->uf             = e($request->input('uf'));
            $client->email          = e($request->input('email'));
            $client->slug           = Str::slug($request->input('name'));
            $client->namecnpj       = e($request->input('fantasia')) .'- CNPJ:'. e($request->input('cnpj'));

            if ($client->save()):

                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');

            endif;
        endif;
    }


    public function postClientSearch(Request $request){
        $rules = [
            'search'  => 'required'
        ];
        $messages = [
            'search.required'    => 'O campo de busca deve ser preenchido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/clients/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $clients = Client::where('cnpj', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $clients = Client::where('fantasia', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['clients' => $clients];
        return view('admin.clients.search', $data);
        endif;
    }

    public function getClientDelete($id){
         $p = Client::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/clients/1')->with('message', 'Registro enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getClientRestore($id){
         $p = Client::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/client/'.$p->id.'/edit')->with('message', 'O registro selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


}
