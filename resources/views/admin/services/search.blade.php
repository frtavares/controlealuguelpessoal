@extends('admin.master')

@section('title', 'Serviços')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/services/1') }}"><i class="fas fa-wrench"></i> Serviços</a>
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
				@if(kvfj(Auth::user()->permissions, 'service_add'))
				<li>
					<a href="{{ url('/admin/service/add') }}">
						<i class="fas fa-plus"></i> Novo
					</a>
				</li>
				@endif
				<li>
					<a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
					<ul class="shadow">
                    <li><a href="{{ url('/admin/services/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
                    <li><a href="{{ url('/admin/services/0') }}"><i class="fas fa-eraser" ></i> Inativo</a></li>
                    <li><a href="{{ url('/admin/services/trash') }}"><i class="fas fa-trash"></i> Lixeira</a></li>
                    <li><a href="{{ url('/admin/services/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
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
				{!! Form::open(['url' => '/admin/service/search']) !!}
				<div class="row">
					<div class="col-md-4">
						{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquise aqui', 'required']) !!}
					</div>
					<div class="col-md-4">
						{!! Form::select('filter', ['0' => 'Descrição', '1' => 'ID'], 0, ['class' => 'form-select']) !!}
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
                        <td>Id</td>
                        <td>Descrição</td>
                        <td>Ações</td>
					</tr>
				</thead>
				<tbody>
					@foreach($services as $p)
					<tr>
						<td width="50">{{ $p->id }}</td>
						<td>{{ $p->name }}</td>


						<td>
							<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'service_edit'))
								<a href="{{ url('/admin/service/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit">
									<i class="fas fa-edit fa-2x"></i>
								</a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'service_delete'))
									@if(is_null($p->deleted_at))
									<a href="" data-path="admin/service" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted delete">
										<i class="fas fa-trash-alt fa-2x"></i>
									</a>
									@else
									<a href="{{ url('/admin/service/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/service" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore">
										<i class="fas fa-trash-restore fa-2x"></i>
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


@section('js')
<script src="{{ url('/static/js/responsive.bootstrap4.min.js') }}"></script>
@endsection
