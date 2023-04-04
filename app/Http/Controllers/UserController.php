<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Image, Auth, Config, Str, Hash;
use App\User;
class UserController extends Controller
{
    public function __Construct(){
    	$this->middleware('auth');
    }

    public function getAcccountEdit(){
        $birthday = (is_null(Auth::user()->birthday)) ? [null,null,null] : explode('-', Auth::user()->birthday);
        $data = ['birthday' => $birthday];
    	return view('user.account_edit', $data);
    }
    public function postAccountAvatar(Request $request){
    	$rules = [
            'avatar' => 'required'
        ];

        $messages = [
            'avatar.required' => 'Selecione uma imagem!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            if($request->hasFile('avatar')):
                $path = '/'.Auth::id();
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads_users.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));

                $filename = rand(1,999).'_'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                

                $u = User::find(Auth::id());
                $aa = $u->avatar;
                $u->avatar = $filename;

                if($u->save()):
                    if($request->hasFile('avatar')):
                        $fl = $request->avatar->storeAs($path, $filename, 'uploads_users');
                        $img = Image::make($file_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/av_'.$filename);
                    endif;
                    unlink($upload_path.'/'.$path.'/'.$aa);
                    unlink($upload_path.'/'.$path.'/av_'.$aa);
                    return back()->with('message', 'Avatar atualizado com sucesso!')->with('typealert', 'success');
                endif;
            endif;
            
        endif;
    }

    public function postAccountPassword(Request $request){
        $rules = [
            'apassword' => 'required|min:8',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];

        $messages = [
            'apassword.required' => 'Escreva sua senha atual.',
            'apassword.min' => 'A senha atual deve ter ao menos 8 caracteres',
            'password.required' => 'Escreva sua nova senha',
            'password.min' => 'Sua nova senha deve ter ao menos 8 caracteres',
            'cpassword.required' => 'Confirme sua nova senha',
            'cpassword.min' => 'A confirmação de sua nova senha deve ter ao menos 8 caracteres',
            'cpassword.same' => 'As senhas não estão iguais'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            $u = User::find(Auth::id());
            if(Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password'));
                if($u->save()):
                    return back()->with('message', 'Senha atualizada com sucesso!')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', 'Sua senha atual não confere!')->with('typealert', 'danger');
            endif;
        endif;
    }

    public function postAccountInfo(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|max:11',
            'year' => 'required',
            'day' => 'required'
        ];

        $messages = [
            'name.required' => 'O campo nome é requerido!',
            'lastname.required' => 'O campo sobrenome é requerido!',
            'phone.required' => 'O campo telefone é requerido!',
            'phone.min' => 'O campo telefone deve ter no mínimo 8 digitos',
            'year' => 'O campo ano é requerido!',
            'day' => 'O campo dia é requerido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            $date = $request->input('day').'-'.$request->input('month').'-'.$request->input('year');
            $u = User::find(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->birthday = date("d-m-Y", strtotime($date));
            $u->gender = e($request->input('gender'));
            if($u->save()):
                return back()->with('message', 'Seus dados foram atualizados com sucesso!')->with('typealert', 'success');
            endif;
        endif;
    }
}
