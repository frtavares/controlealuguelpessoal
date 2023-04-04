<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Service;

use Validator, Str, Config, Image, Auth, PDF, DateTime, DB;

class ServiceController extends Controller
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
                $services = Service::where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $services = Service::where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $services = Service::orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $services = Service::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['services' => $services];
        return view('admin.services.home', $data);
    }

    public function getServiceAdd(){

        $services = Service::orderBy('name', 'Asc')->get();
        $data = ['services' => $services];

        return view('admin.services.add', $data);
    }

    public function postServiceAdd(Request $request){
        $rules = [
             // 'name'      => 'required',
              'name'      => 'required|unique:services',
        ];

        $messages = [
             // 'name.required'    => 'O campo não pode ficar vazio!',
              'name.unique'      => 'Já existe este registro no banco de dados!',
        ];

        $validar = Validator::make($request->all(), $rules, $messages);
        if($validar->fails()):
            return back()->withErrors($validar)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:
            $service = new Service;
            $service->status             = '1'; 
            $service->name               = Str::upper(e($request->input('name')));
            $service->slug               = Str::slug($request->input('name'));
            
            if ($service->save()):

              
               return redirect('/admin/services/1')->with('message', 'Gravado com sucesso!')->with('typealert', 'success');
            endif;
    
        endif;

    }

    public function getServiceEdit($id){

        $p = Service::findOrFail($id);
        $services = Service::where('name', 'id');
        $data = ['services' => $services, 'p' => $p];
        return view('admin.services.edit', $data);

    }

    public function postServiceEdit($id, Request $request){
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

            $service           = Service::findOrFail($id);
            $service->status   = '1'; 
            $service->name     = Str::upper(e($request->input('name')));
            $service->slug     = Str::slug($request->input('name'));

            if ($service->save()):

                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');

            endif;
        endif;
    }


    public function postServiceSearch(Request $request){
        $rules = [
            'search'  => 'required'
        ];
        $messages = [
            'search.required'    => 'O campo de busca deve ser preenchido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/services/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $services = Service::where('name', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $services = Service::where('id', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['services' => $services];
        return view('admin.services.search', $data);
        endif;
    }

    public function getServiceDelete($id){
         $p = Service::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/services/1')->with('message', 'Produto enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getServiceRestore($id){
         $p = Service::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/service/'.$p->id.'/edit')->with('message', 'O produto selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


}
