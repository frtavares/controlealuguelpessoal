@extends('admin.master')

@section('title', 'Incluir Cliente')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/services/1') }}"><i class="fas fa-wrench"></i> Serviço</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/service/add') }}"><i class="fas fa-plus"></i> Incluir Serviço</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<!-- <h2 class="title"><i class="fas fa-plus"></i> Incluir Cliente</h2> -->
		</div>

		<div class="inside">
            {!! Form::open(['url' => '/admin/service/add', 'files' => 'true']) !!}
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
