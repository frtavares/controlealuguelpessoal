<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Manuseio;
use Validator, Str, Config, Image, Auth, PDF, DateTime, DB;


class ManuseioController extends Controller
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
                $manuseios = Manuseio::where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $manuseios = Manuseio::where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $manuseios = Manuseio::orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $manuseios = Manuseio::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['manuseios' => $manuseios];
        return view('admin.manuseios.home', $data);
    }

    public function getManuseioAdd(){

        $manuseios = Manuseio::orderBy('name', 'Asc')->get();
        $data = ['manuseios' => $manuseios];

        return view('admin.manuseios.add', $data);
    }

    public function postManuseioAdd(Request $request){
        $rules = [
             'name'      => 'required',
             'name'      => 'required|unique:manuseios',
        ];

        $messages = [
             'name.required'    => 'O campo não pode ficar vazio!',
             'name.unique'      => 'Já existe este registro no banco de dados!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:
            $manuseio = new Manuseio;
            $manuseio->status             = '1'; 
            $manuseio->name               = Str::upper(e($request->input('name')));
            $manuseio->slug               = Str::slug($request->input('name'));
            
            if ($manuseio->save()):

                return redirect('/admin/manuseios/1')->with('message', 'Gravado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getManuseioEdit($id){

        $p = Manuseio::findOrFail($id);
        $manuseios = Manuseio::where('name', 'id');
        $data = ['manuseios' => $manuseios, 'p' => $p];
        return view('admin.manuseios.edit', $data);

    }

    public function postManuseioEdit($id, Request $request){
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

            $manuseio           = Manuseio::findOrFail($id);
            $manuseio->status   = '1'; 
            $manuseio->name     = Str::upper(e($request->input('name')));
            $manuseio->slug     = Str::slug($request->input('name'));

            if ($manuseio->save()):

                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');

            endif;
        endif;
    }


    public function postManuseioSearch(Request $request){
        $rules = [
            'search'  => 'required'
        ];
        $messages = [
            'search.required'    => 'O campo de busca deve ser preenchido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/manuseios/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $manuseios = Manuseio::where('name', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $manuseios = Manuseio::where('id', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['manuseios' => $manuseios];
        return view('admin.manuseios.search', $data);
        endif;
    }

    public function getManuseioDelete($id){
         $p = Manuseio::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/manuseios/1')->with('message', 'Produto enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getManuseioRestore($id){
         $p = Manuseio::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/manuseio/'.$p->id.'/edit')->with('message', 'O produto selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


}
