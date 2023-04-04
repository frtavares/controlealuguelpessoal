<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Occupation;
use Validator, Str;

class OccupationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($status){

        $occs = Occupation::where('status', '1')->orderBy('name', 'Asc')->get();
       
        $data = ['occs' => $occs];

        return view('admin.occupations.home', $data);
    }

    public function postOccupationAdd(Request $request){

        $rules = [
            'name'      => 'required|unique:services',

        ];

        $messages = [

            'name.required'      => 'O campo name não pode ficar vazio!',
            'name.unique'        => 'Exsite uma categoria com este name!'

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um ou mais erros!')->with(
                'typealert', 'danger')->withInput();
        else:
            $c = new Occupation;
            $c->status  = '1';
            $c->name    = e($request->input('name'));
            $c->slug    = Str::slug($request->input('name'));

            if ($c->save()):
                return back()->with('message', 'Cadastrado com sucesso!')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getOccupationEdit($id){

        $occ    = Occupation::find($id);
        $data   = ['occ' => $occ];
        return view('admin.occupations.edit', $data);
    }

    public function postOccupationEdit(Request $request, $id){

        $rules = [
            'name'      => 'required|unique:categories',
        ];

        $messages = [

            'name.required'      => 'O campo nome não pode ficar vazio!',
            'name.unique'        => 'Exsite uma categoria com este nome!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um ou mais erros!')->with(
                'typealert', 'danger');
        else:
            $c = Occupation::find($id);
            $c->status  = $request->input('status');
            $c->name    = e($request->input('name'));
            $c->slug    = Str::slug($request->input('name'));

            if ($c->save()):
                return back()->with('message', 'Editado com sucesso!')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getOccupationDelete($id){

        $c = Occupation::find($id);
        if ($c->delete()):
            return back()->with('message', 'Excluído com sucesso!')->with('typealert', 'warning');
        endif;

    }

}
