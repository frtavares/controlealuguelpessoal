@extends('admin.master')

@section('title', 'Incluir Tipo Manuseio')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/manuseios/1') }}"><i class="fas fa-box-open"></i> Tipo Manuseio</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/manuseio/add') }}"><i class="fas fa-plus"></i> Incluir Tipo Manuseio</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<!-- <h2 class="title"><i class="fas fa-plus"></i> Incluir Cliente</h2> -->
		</div>

		<div class="inside">
            @if(kvfj(Auth::user()->permissions, 'manuseio_add'))
                {!! Form::open(['url' => '/admin/manuseio/add']) !!}
                <div class="row">
                    <div class="col-md-3">
                        <label for="name">Descrição</label>
                        <div class="input-group">
                            <div class="input-group-prepend">

                            </div>
                            {!! Form::text('name', null, ['class' => 'form-control' , 'style'=>'text-transform: uppercase;'] ) !!}
                        </div>
                    </div>
                </div>
            @endif
                <div class="row mtop16">
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



@endsection
