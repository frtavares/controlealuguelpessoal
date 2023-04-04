@extends('admin.master')

@section('title', 'Pessoas')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/pessoas/1') }}"><i class="fas fa-user-friends"></i> Pessoas</a>
</li>
@endsection

@section('css')
<link rel="stylesheet" href="{{ url('/static/css/rowGroup.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">

			<ul style="float:left;margin-left:20px;">
				@if(kvfj(Auth::user()->permissions, 'pessoa_add'))
				<li >
					<a href="{{ url('/admin/pessoa/add') }}">
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
						<li><a href="{{ url('/admin/pessoas/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
						<li><a href="{{ url('/admin/pessoas/0') }}"><i class="fas fa-eraser" ></i> Inativo</a></li>
						<li><a href="{{ url('/admin/pessoas/trash') }}"><i class="fas fa-trash"></i> Lixeira</a></li>
						<li><a href="{{ url('/admin/pessoas/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
					</ul>
				</li>
            </ul>
		</div>

		<div class="inside">

			<div class="form_search" id="form_search">
				{!! Form::open(['url' => '/admin/pessoa/search']) !!}
				<div class="row">
					<div class="col-md-4">
						{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquise aqui', 'required']) !!}
					</div>
					<div class="col-md-4">
						{!! Form::select('filter', ['0' => 'Nome', '1' => 'CPF'], 0, ['class' => 'form-select']) !!}
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
						<td>Nome</td>
                        <td>CPF</td>
                        <td>Função</td>
                        <td>Ações</td>
					</tr>
				</thead>
				<tbody>
					@foreach($pessoas as $p)
					<tr>
						<td>{{ $p->name }}</td>
                        <td>{{ $p->cpf }}</td>
                        <td>{{ $p->occs->name }}</td>

						<td>
							<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'pessoa_edit'))
								<a href="{{ url('/admin/pessoa/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit">
									<i class="fas fa-edit fa-2x"></i>
								</a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'pessoa_delete'))
									@if(is_null($p->deleted_at))
									<a href="" data-path="admin/pessoa" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted delete">
										<i class="fas fa-trash-alt fa-2x"></i>
									</a>
									@else
									<a href="{{ url('/admin/pessoa/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/pessoa" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore">
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


@section('js')
<script src="{{ url('/static/js/responsive.bootstrap4.min.js') }}"></script>
@endsection


<script>

function delete_object(e){
	e.preventDefault();
	var object = this.getAttribute('data-object');
	var action =  this.getAttribute('data-action');
	var path = this.getAttribute('data-path');
	var url = base + '/' + path + '/' + object + '/'+ action;
	var title, text, icon;
	if(action == "delete"){
		title = "¿Estas seguro de eliminar este objecto?";
		text = "Recuerda que esta acción enviara este elemento a la papelera o lo eliminara de forma definitiva.";
		icon = "warning";
	}
	if(action == "restore"){
		title = "¿Quieres restaurar este elemento?";
		text = "Esta acción restaurará este elemento y estará activo en la base de datos.";
		icon = "info";
	}
	Swal.fire({
		title: title,
		text: text,
		icon: icon,
		showCancelButton: true,
	}).then((result) => {
		if (result.value) {
			window.location.href = url;
		}
	});
}

</script>
@endsection
