<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Iso;

use Validator, Str, Config, Image;

class IsoController extends Controller
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
                $isos = Iso::where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $isos = Iso::where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $isos = Iso::orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $isos = Iso::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['isos' => $isos];
        return view('admin.isos.home', $data);
    }

    public function getIsoAdd(){

        $isos = Iso::orderBy('name', 'Asc')->get();
        $data = ['isos' => $isos];

        return view('admin.isos.add', $data);
    }

    public function postIsoAdd(Request $request){
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
            $iso = new Iso;
            $iso->status             = '1'; 
            $iso->name               = Str::upper(e($request->input('name')));
           
            
            if ($iso->save()):

                return redirect('/admin/isos/'.$iso->id. '/edit')->with('message', 'Gravado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getIsoEdit($id){

        $p = Iso::findOrFail($id);
        $isos = Iso::where('name', 'id');
        $data = ['isos' => $isos, 'p' => $p];
        return view('admin.isos.edit', $data);

    }

    public function postIsoEdit($id, Request $request){
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

            $iso           = Iso::findOrFail($id);
            $iso->status   = '1'; 
            $iso->name     = Str::upper(e($request->input('name')));
            

            if ($iso->save()):

                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');

            endif;
        endif;
    }


    public function postIsoSearch(Request $request){
        $rules = [
            'search'  => 'required'
        ];
        $messages = [
            'search.required'    => 'O campo de busca deve ser preenchido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/isos/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $isos = Iso::where('name', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $isos = Iso::where('id', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['isos' => $isos];
        return view('admin.isos.search', $data);
        endif;
    }

    public function getIsoDelete($id){
         $p = Iso::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/isos/1')->with('message', 'Produto enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getIsoRestore($id){
         $p = Iso::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/iso/'.$p->id.'/edit')->with('message', 'O produto selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


}
