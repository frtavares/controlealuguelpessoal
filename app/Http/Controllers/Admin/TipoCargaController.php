<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\TipoCarga;

use Validator, Str, Config, Image;

class TipoCargaController extends Controller
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
                $tipocargas = TipoCarga::where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $tipocargas = TipoCarga::where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $tipocargas = TipoCarga::orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $tipocargas = TipoCarga::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['tipocargas' => $tipocargas];
        return view('admin.tipocargas.home', $data);
    }

    public function getTipoCargaAdd(){

        $tipocargas = TipoCarga::orderBy('name', 'Asc')->get();
        $data = ['tipocargas' => $tipocargas];

        return view('admin.tipocargas.add', $data);
    }

    public function postTipoCargaAdd(Request $request){
        $rules = [
             'name'      => 'required',
             'name'      => 'required|unique:isos',
        ];

        $messages = [
             'name.required'    => 'O campo não pode ficar vazio!',
             'name.unique'      => 'Já existe este registro no banco de dados!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:
            $tipocarga = new TipoCarga;
            $tipocargas->status             = '1'; 
            $tipocarga->name               = Str::upper(e($request->input('name')));
            $tipocarga->slug               = Str::slug($request->input('name'));
            
            if ($tipocarga->save()):

                return redirect('/admin/tipocargas/1')->with('message', 'Gravado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getTipoCargaEdit($id){

        $p = TipoCarga::findOrFail($id);
        $tipocargas = TipoCarga::where('name', 'id');
        $data = ['tipocargas' => $tipocargas, 'p' => $p];
        return view('admin.tipocargas.edit', $data);

    }

    public function postTipoCargaEdit($id, Request $request){
        $rules = [
             'name'      => 'required',
            
        ];

        $messages = [

             'name.required'    => 'O campo não pode ficar vazio!',
             
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:

            $tipocarga           = TipoCarga::findOrFail($id);
            $tipocarga->status   = '1'; 
            $tipocarga->name     = Str::upper(e($request->input('name')));
            $tipocarga->slug     = Str::slug($request->input('name'));

            if ($tipocarga->save()):

                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');

            endif;
        endif;
    }


    public function postTipoCargaSearch(Request $request){
        $rules = [
            'search'  => 'required'
        ];
        $messages = [
            'search.required'    => 'O campo de busca deve ser preenchido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/tipocargas/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $tipocargas = TipoCarga::where('name', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $tipocargas = TipoCarga::where('id', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['tipocargas' => $tipocargas];
        return view('admin.tipocargas.search', $data);
        endif;
    }

    public function getTipoCargaDelete($id){
         $p = TipoCarga::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/tipocargas/1')->with('message', 'Produto enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getTipoCargaRestore($id){
         $p = TipoCarga::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/tipocarga/'.$p->id.'/edit')->with('message', 'O produto selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


}
