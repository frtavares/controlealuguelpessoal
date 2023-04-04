@extends('admin.master')

@section('title', 'Incluir Transportadora')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/transportadoras/1') }}"><i class="fas fa-truck"></i> Transportadora</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/transportadora/add') }}"><i class="fas fa-plus"></i> Incluir Transportadora</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<!-- <h2 class="title"><i class="fas fa-plus"></i> Incluir Cliente</h2> -->
		</div>

		<div class="inside">
        {!! Form::open(['url' => '/admin/transportadora/add', 'files' => 'true']) !!}
                    <div class="row">
                        <div class="col-md-3">
                            <label for="cnpj">CNPJ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('cnpj', null, ['class' => 'form-control' , 'onblur' => 'checkCnpj(this.value)'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="name">Razão Social</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('name', null, ['class' => 'form-control' , 'id' => 'razaosocial',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="fantasia">Nome Fantasia</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('fantasia', null, ['class' => 'form-control', 'id' => 'fantasia','style'=>'text-transform: uppercase;'] ) !!}
                            </div>

                        </div>
                    </div>



                    <div class="row mtop16">
                        <div class="col-md-2">
                            <label for="cep">CEP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('cep', null, ['class' => 'form-control', 'id' => 'cep',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="logradouro">Endereço</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('logradouro', null, ['class' => 'form-control', 'id' => 'logradouro',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="numero">Número</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('numero', null, ['class' => 'form-control', 'id' => 'numero',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="complemento">Complemto:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('complemento', null, ['class' => 'form-control', 'id' => 'complemento', 'style'=>'text-transform: uppercase;'] ) !!}
                            </div>
                        </div>
                    </div>


                    <div class="row mtop16">
                        <div class="col-md-3">
                            <label for="bairro">Bairro:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('bairro', null, ['class' => 'form-control', 'id' => 'bairro',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="municipio">Município:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('municipio', null, ['class' => 'form-control', 'id' => 'municipio',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="uf">UF:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('uf', null, ['class' => 'form-control', 'id' => 'uf',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="email">E-mail:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email'] ) !!}
                            </div>
                        </div>
                      <div class="col-md-4">
                            <label for="namecnpj"></label>
                            <div class="input-group">

                                {!! Form::hidden('namecnpj', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid mtop16"></div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Salvar', ['class' => 'btn btn-success'])!!}
                        </div>
                    </div>

                    {!! Form::close()!!}
		</div>
	</div>
</div>
@endsection

@section('js')


<script>
    function checkCnpj(cnpj) {
        $.ajax({
            'url': 'https://www.receitaws.com.br/v1/cnpj/' + cnpj.replace(/[^0-9]/g, ''),
            'type': "GET",
            'dataType': 'jsonp',
            'success': function(data) {
                if (data.nome == undefined) {
                    alert(data.status + '  ' + data.message)
                } else {
                    document.getElementById('razaosocial').value = data.nome;
                    document.getElementById('fantasia').value = data.fantasia;
                    document.getElementById('cep').value = data.cep;
                    document.getElementById('logradouro').value = data.logradouro;
                    document.getElementById('numero').value = data.numero;
                    document.getElementById('complemento').value = data.complemento;
                    document.getElementById('email').value = data.email;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('municipio').value = data.municipio;
                    document.getElementById('uf').value = data.uf;
                }
                console.log(data);
            }
        })
    }
</script>

@endsection
