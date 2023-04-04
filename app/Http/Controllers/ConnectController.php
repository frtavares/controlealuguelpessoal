<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth, Mail, Str;
use App\Mail\UserSendRecover, App\Mail\UserSendNewPassword;
use App\User;

class ConnectController extends Controller
{
	public function __construct(){
		$this->middleware('guest')->except(['getLogout']);
	}

    public function getLogin(){
    	return view('connect.login');
    }

    public function postLogin(Request $request){
    	$rules = [
    		'email' => 'required|email',
    		'password' => 'required|min:8'
    	];

    	$messages = [
    		'email.required' => 'O campo e-mail não pode ficar vazio!',
    		'email.email' => 'Formato do e-mail é inválido!',
    		'password.required' => 'Por favor inserir a senha!',
    		'password.min' => 'A senha de ter no mínimo 8 caracteres!',
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger');
    	else:

    		if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)):
                if(Auth::user()->status == "100"):
                    return redirect('/logout');
                else:
                    return redirect('/');
                endif;
    		else:
    			return back()->with('message', 'E-mail ou senha inválidos!')->with('typealert', 'danger');
    		endif;

    	endif;

    }

    public function getRegister(){
    	return view('connect.register');
    }

    public function postRegister(Request $request){
    	$rules = [
    		'name' => 'required',
    		'lastname' => 'required',
    		'email' => 'required|email|unique:users,email',
    		'password' => 'required|min:8',
    		'cpassword' => 'required|min:8|same:password',
    	];

    	$messages = [
    		'name.required' => 'O campo nome não pode ficar vazio!',
    		'lastname.required' => 'O campo sobrenome não pode ficar vazio!',
    		'email.required' => 'O campo e-mail não pode ficar vazio!',
    		'email.email' => 'O formato do e-mail é inválido!',
    		'email.unique' => 'Já existe um usuário com este e-mail cadastrado!',
    		'password.required' => 'Por favor escreva a senha!',
    		'password.min' => 'A senha de ter no mínimo 8 caracteres!',
    		'cpassword.required' => 'É necessário confirmar a senha!',
    		'cpassword.min' => 'A confirmação da senha de ter no mínimo 8 caracteres!',
    		'cpassword.same' => 'A senhas não são iguais!'
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger');
    	else:
    		$user = new User;
    		$user->name = e($request->input('name'));
    		$user->lastname = e($request->input('lastname'));
    		$user->email = $request->input('email');
    		$user->password = Hash::make($request->input('password'));

    		if($user->save()):
    			return redirect('/login')->with('message', 'Usuário criado com sucesso, agora pode iniciar a sessão! ')->with('typealert', 'success');
    		endif;
    	endif;
    }

    public function getLogout(){
        $status = Auth::user()->status;
        Auth::logout();
        if($status == "100"):
            return redirect('/login')->with('message', 'Seu usuário está suspenso!')->with('typealert', 'danger');
        else:
            return redirect('/');
        endif;
    	
    }

    public function getRecover(){
        return view('connect.recover');
    }

    public function postRecover(Request $request){
        $rules = [
            'email' => 'required|email'
        ];

        $messages = [
            'email.required' => 'E-mail é requeido.',
            'email.email' => 'O formato do e-mail é invalido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger');
        else:
            $user = User::where('email', $request->input('email'))->count();
            if($user == "1"):
                $user = User::where('email', $request->input('email'))->first();
                $code = rand(100000, 999999);
                $data = ['name' => $user->name, 'email' => $user->email, 'code' => $code];
                $u = User::find($user->id);
                $u->password_code = $code;
                if($u->save()):
                Mail::to($user->email)->send(new UserSendRecover($data));
                return redirect('/reset?email='.$user->email)->with('message', 'Insira o código que enviamos para o seu e-mail!')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', 'Este e-mail não existe.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getReset(Request $request){
        $data = ['email' => $request->get('email')];
         return view('connect.reset', $data);
    }

    public function postReset(Request $request){
        $rules = [
            'email' => 'required|email',
            'code' => 'required'
        ];

        $messages = [
            'email.required' => 'e-mail é requerido.',
            'email.email' => 'O formato do e-mail é  invalido',
            'code.required' => 'O código de recuperação é requerido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger');
        else:
            $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->count();
            if($user == "1"):
                $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->first();
                $new_password = Str::random(8);
                $user->password = Hash::make($new_password);
                $user->password_code = null;
                if($user->save()):
                    $data = ['name' => $user->name, 'password' => $new_password];
                    Mail::to($user->email)->send(new UserSendNewPassword($data));
                    return redirect('/login')->with('message', 'A validação foi realizada com sucesso, enviamos a nova senha provisória para seu e-mail! Depois de logar altere a senha no seu perfil.')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', 'O e-mail ou o código de validação são inválidos!')->with('typealert', 'danger');
            endif;
        endif;
    }
}
