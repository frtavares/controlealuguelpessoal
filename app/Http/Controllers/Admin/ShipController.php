<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Ship;

use Validator, Str, Config, Image;

class ShipController extends Controller
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
                $ships = Ship::where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $ships = Ship::where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $ships = Ship::orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $ships = Ship::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['ships' => $ships];
        return view('admin.ships.home', $data);
    }

    public function getShipAdd(){

        $ships = Ship::orderBy('name', 'Asc')->get();
        $data = ['ships' => $ships];

        return view('admin.ships.add', $data);
    }

    public function postShipAdd(Request $request){
        $rules = [
            'name'      => 'required',
            'name'      => 'required|unique:ships',
        ];

        $messages = [

            'name.required'    => 'O campo não pode ficar vazio!',
            'name.unique'      => 'Já existe este registro no banco de dados!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:
            $ship = new Ship;
            $ship->status             = '1';
            $ship->name               = e($request->input('name'));


            if ($ship->save()):

                return redirect('/admin/ships/'.$ship->id. '/edit')->with('message', 'Gravado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getShipEdit($id){

        $p = Ship::findOrFail($id);
        $ships = Ship::where('name', 'id');
        $data = ['ships' => $ships, 'p' => $p];
        return view('admin.ships.edit', $data);

    }

    public function postShipEdit($id, Request $request){
        $rules = [
            'name'      => 'required',

        ];

        $messages = [

            'name.required'    => 'O campo nome não pode ficar vazio!',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:

            $ship                     = Ship::findOrFail($id);
            $ship->status             = '1';
            $ship->name               = e($request->input('name'));


            if ($ship->save()):

                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');

            endif;
        endif;
    }


    public function postShipSearch(Request $request){
        $rules = [
            'search'  => 'required'
        ];
        $messages = [
            'search.required'    => 'O campo de busca deve ser preenchido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/ships/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $ships = Ship::where('name', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $ships = Ship::where('id', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['ships' => $ships];
        return view('admin.ships.search', $data);
        endif;
    }

    public function getShipDelete($id){
         $p = Ship::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/ships/1')->with('message', 'Registro enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getShipRestore($id){
         $p = Ship::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/ship/'.$p->id.'/edit')->with('message', 'O registro selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }


}
