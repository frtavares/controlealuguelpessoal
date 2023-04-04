@extends('emails.master')

@section('content')

<p>Olá, <strong>{{ $name }}</strong></p>

<p>Segue a senha provisória da sua conta em frtSys, conforme solicitado: </p>

<p><h3>{{ $password }}</h3></p>

<p>Para logar no site clique no botão abaixo: </p>

<p><a href="{{ url('/login') }}" style="display: inline-block; background-color: #2caaff; color: #fff; padding: 12px; border-radius: 4px; text-decoration: none;">Recuperar minha senha</a></p>

<p>No caso do botão acima não funcionar tente no endereço : </p>
<p>{{ url('/login') }}</p>

@stop
