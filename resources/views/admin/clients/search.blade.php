@extends('admin.master')

@section('title', 'Clientes')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/clients/1') }}"><i class="fas fa-handshake"></i> Clientes</a>
</li>
@endsection

@section('css')
<link rel="stylesheet" href="{{ url('/static/css/rowGroup.bootstrap4.min.css') }}">
@endsection


@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">

			<ul>
				@if(kvfj(Auth::user()->permissions, 'client_add'))
				<li>
					<a href="{{ url('/admin/client/add') }}">
						<i class="fas fa-plus"></i> Novo
					</a>
				</li>
				@endif
				<li>
					<a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
					<ul class="shadow">
						<li><a href="{{ url('/admin/clients/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
						<li><a href="{{ url('/admin/clients/0') }}"><i class="fas fa-eraser" ></i> Inativo</a></li>
						<li><a href="{{ url('/admin/clients/trash') }}"><i class="fas fa-trash"></i> Lixeira</a></li>
						<li><a href="{{ url('/admin/clients/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
					</ul>
				</li>
				<li>
					<a href="#" id="btn_search">
						<i class="fas fa-search"></i> Buscar
					</a>
				</li>
			</ul>
		</div>

		<div class="inside">

			<div class="form_search" id="form_search">
				{!! Form::open(['url' => '/admin/client/search']) !!}
				<div class="row">
					<div class="col-md-4">
						{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquise aqui', 'required']) !!}
					</div>
					<div class="col-md-4">
						{!! Form::select('filter', ['0' => 'CNPJ', '1' => 'Nome Fantasia'], 0, ['class' => 'form-select']) !!}
					</div>
					<div class="col-md-2">
						{!! Form::select('status', ['1' => 'Públicos', '0' => 'Inativo'], 0, ['class' => 'form-select']) !!}
					</div>
					<div class="col-md-2">
						{!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>

			<table class="table table-striped">
				<thead>
					<tr>
						 <td>#</td>
						 <td>Razão Social</td>
                        <td>Nome Fantasia</td>
                        <td>CNPJ</td>
                        <td>Ações</td>
					</tr>
				</thead>
				<tbody>
					@foreach($clients as $p)
					<tr>
						<td width="50">{{ $p->id }}</td>
						<td>{{ $p->name }}</td>
                        <td>{{ $p->fantasia }}</td>
                        <td>{{ $p->cnpj }}</td>

						<td>
							<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'client_edit'))
								<a href="{{ url('/admin/client/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit">
									<i class="fas fa-edit"></i>
								</a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'client_delete'))
									@if(is_null($p->deleted_at))
									<a href="" data-path="admin/client" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted delete">
										<i class="fas fa-trash-alt"></i>
									</a>
									@else
									<a href="{{ url('/admin/client/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/client" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore">
										<i class="fas fa-trash-restore"></i>
									</a>
									@endif
								@endif
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection


@@section('js')
<script src="{{ url('/static/js/responsive.bootstrap4.min.js') }}"></script>
@endsection