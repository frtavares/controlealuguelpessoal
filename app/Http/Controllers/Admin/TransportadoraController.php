<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Transportadora;

use Validator, Str, Config, Image;

class TransportadoraController extends Controller
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
                $transportadoras = Transportadora::where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $transportadoras = Transportadora::where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $transportadoras = Transportadora::orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $transportadoras = Transportadora::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['transportadoras' => $transportadoras];
        return view('admin.transportadoras.home', $data);
    }

    public function getTransportadoraAdd(){

        $transportadoras = Transportadora::orderBy('name', 'Asc')->get();
        $data = ['transportadoras' => $transportadoras];

        return view('admin.transportadoras.add', $data);
    }

    public function postTransportadoraAdd(Request $request){
        $rules = [
            'name'      => 'required',
            'fantasia'  => 'required',
            'cnpj'      => 'required|cnpj|unique:transportadoras',
        ];

        $messages = [
            'name.required'    => 'O campo Razão Social não pode ficar vazio!',
            'fantasia.required'=> 'O campo fantasia não pode ficar vazio!',
            'cnpj.required'    => 'O campo CNPJ não pode ficar vazio!',
            'cnpj.unique'      => 'Já existe este CNPJ no banco de dados!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:
            $transportadora = new Transportadora;
            $transportadora->name               = e($request->input('name'));
            $transportadora->status             = '1';
            $transportadora->fantasia           = Str::upper(e($request->input('fantasia')));
            $transportadora->cnpj               = e($request->input('cnpj'));
            $transportadora->cep                = e($request->input('cep'));
            $transportadora->logradouro         = e($request->input('logradouro'));
            $transportadora->numero             = e($request->input('numero'));
            $transportadora->complemento        = e($request->input('complemento'));
            $transportadora->bairro             = e($request->input('bairro'));
            $transportadora->municipio          = e($request->input('municipio'));
            $transportadora->uf                 = e($request->input('uf'));
            $transportadora->email              = e($request->input('email'));
            $transportadora->slug               = Str::slug($request->input('name'));
            $transportadora->namecnpj           = e($request->input('fantasia')) .'- CNPJ:'. e($request->input('cnpj'));

            if ($transportadora->save()):

                return redirect('/admin/transportadoras/'.$transportadora->id. '/edit')->with('message', 'Gravado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getTransportadoraEdit($id){

        $p = Transportadora::findOrFail($id);
        $transportadoras = Transportadora::where('name', 'id');
        $data = ['transportadoras' => $transportadoras, 'p' => $p];
        return view('admin.transportadoras.edit', $data);

    }

    public function postTransportadoraEdit($id, Request $request){
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

            $transportadora                 = Transportadora::findOrFail($id);
            $transportadora->name           = e($request->input('name'));
            $transportadora->status         = '1';
            $transportadora->fantasia       = Str::upper(e($request->input('fantasia')));
            $transportadora->cnpj           = e($request->input('cnpj'));
            $transportadora->cep            = e($request->input('cep'));
            $transportadora->logradouro     = e($request->input('logradouro'));
            $transportadora->numero         = e($request->input('numero'));
            $transportadora->complemento    = e($request->input('complemento'));
            $transportadora->bairro         = e($request->input('bairro'));
            $transportadora->municipio      = e($request->input('municipio'));
            $transportadora->uf             = e($request->input('uf'));
            $transportadora->email          = e($request->input('email'));
            $transportadora->slug           = Str::slug($request->input('name'));
            $transportadora->namecnpj       = e($request->input('fantasia')) .'- CNPJ:'. e($request->input('cnpj'));

            if ($transportadora->save()):

                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');

            endif;
        endif;
    }


    public function postTransportadoraSearch(Request $request){
        $rules = [
            'search'  => 'required'
        ];
        $messages = [
            'search.required'    => 'O campo de busca deve ser preenchido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/transportadoras/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $transportadoras = Transportadora::where('cnpj', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $transportadoras = Transportadora::where('fantasia', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['transportadoras' => $transportadoras];
        return view('admin.transportadoras.search', $data);
        endif;
    }

    public function getTransportadoraDelete($id){
         $p = Transportadora::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/transportadoras/1')->with('message', 'Registro enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getTransportadoraRestore($id){
         $p = Transportadora::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/transportadora/'.$p->id.'/edit')->with('message', 'O registro selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


}
