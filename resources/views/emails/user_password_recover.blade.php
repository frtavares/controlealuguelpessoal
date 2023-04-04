@extends('emails.master')

@section('content')

<p>Olá, <strong>{{ $name }}</strong></p>

<p>Alguém solicitou recentemente uma alteração de senha da sua conta em frtSys.</p>

<p>Se foi você, clique no botão abaixo para redefinir sua senha, copie e cole o código: <h3>{{ $code }}</h3></p>

<p><a href="{{ url('/reset?email='.$email) }}" style="display: inline-block; background-color: #2caaff; color: #fff; padding: 12px; border-radius: 4px; text-decoration: none;">Recuperar minha senha</a></p>

<p>No caso do botão acima não funcionar tente no endereço : </p>
<p>{{ url('/reset?email='.$email) }}</p>

@stop
