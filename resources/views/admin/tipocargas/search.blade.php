@extends('admin.master')

@section('title', 'Tipo Carga')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/tipocargas/1') }}"><i class="fas fa-boxes"></i> Tipo Carga</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">

			<ul style="float:left;margin-left:20px;">
                @if(kvfj(Auth::user()->permissions, 'tipocarga_add'))
                <li >
                    <a href="{{ url('/admin/tipocarga/add') }}">
                        <i class="fas fa-plus"></i> Novo
                    </a>
                </li>
                @endif

                <li>
                    <a href="#" id="btn_search">
                        <i class="fas fa-search"></i> Buscar
                    </a>
                </li>



            </ul>
            <ul>
            <li>
                    <a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
                    <ul class="shadow">
                        <li><a href="{{ url('/admin/tipocargas/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
                        <li><a href="{{ url('/admin/tipocargas/0') }}"><i class="fas fa-eraser" ></i> Inativo</a></li>
                        <li><a href="{{ url('/admin/tipocargas/trash') }}"><i class="fas fa-trash"></i> Lixeira</a></li>
                        <li><a href="{{ url('/admin/tipocargas/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
                    </ul>
                </li>
            </ul>
		</div>

		<div class="inside">

			<div class="form_search" id="form_search">
				{!! Form::open(['url' => '/admin/tipocarga/search']) !!}
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
					@foreach($tipocargas as $p)
					<tr>
						<td width="50">{{ $p->id }}</td>
						<td>{{ $p->name }}</td>


						<td>
							<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'tipocarga_edit'))
								<a href="{{ url('/admin/tipocarga/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit mtop16">
									<i class="fas fa-edit fa-2x"></i>
								</a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'tipocarga_delete'))
									@if(is_null($p->deleted_at))
									<a href="" data-path="admin/tipocarga" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted delete mtop16">
										<i class="fas fa-trash-alt fa-2x"></i>
									</a>
									@else
									<a href="{{ url('/admin/tipocarga/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/tipocarga" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore mtop16">
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

