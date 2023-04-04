@extends('admin.master')

@section('title', 'Products')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products/1') }}"><i class="fas fa-boxes"></i> Produtos</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fas fa-boxes"></i> Produtos</h2>
			<ul>
				@if(kvfj(Auth::user()->permissions, 'product_add'))
				<li>
					<a href="{{ url('/admin/product/add') }}">
						<i class="fas fa-plus"></i> Incluir produto
					</a>
				</li>
				@endif
				<li>
					<a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
					<ul class="shadow">
						<li><a href="{{ url('/admin/products/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
						<li><a href="{{ url('/admin/products/0') }}"><i class="fas fa-eraser" ></i> Inativo</a></li>
						<li><a href="{{ url('/admin/products/trash') }}"><i class="fas fa-trash"></i> Lixeira</a></li>
						<li><a href="{{ url('/admin/products/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
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
				{!! Form::open(['url' => '/admin/product/search']) !!}
				<div class="row">
					<div class="col-md-4">
						{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda']) !!}
					</div>
					<div class="col-md-4">
						{!! Form::select('filter', ['0' => 'Nome do produto', '1' => 'Código'], 0, ['class' => 'form-select']) !!}
					</div>
					<div class="col-md-2">
						{!! Form::select('status', ['0' => 'Inativos', '1' => 'Públicos'], 0, ['class' => 'form-select']) !!}
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
						<td>ID</td>
						<td></td>
						<td>Nome</td>
						<td>Categoria + Sub Categoria</td>
						<td>Preço</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $p)
					<tr>
						<td width="50">{{ $p->id }}</td>
						<td width="64">
							<a href="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" data-fancybox="gallery">
								<img src="{{ url('/uploads/'.$p->file_path.'/t_'.$p->image) }}" width="64">
							</a>
						</td>
						<td>{{ $p->name }} @if($p->status == "0") <i class="fas fa-eraser" data-toggle="tooltip" data-placement="top" title="Estado: Inativo"></i> @endif</td>
						<td>{{ $p->cat->name }} @if($p->subcategory_id != "0") <i class="fas fa-angle-double-right"></i> {{ $p->getSubcategory->name }} @endif</td>
						<td>{{ $p->price }}</td>
						<td>
							<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'product_edit'))
								<a href="{{ url('/admin/product/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
									<i class="fas fa-edit"></i>
								</a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'product_delete'))
									@if(is_null($p->deleted_at))
									<a href="" data-path="admin/product" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted delete">
										<i class="fas fa-trash-alt"></i>
									</a>
									@else
									<a href="{{ url('/admin/product/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/product" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore">
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


@section('js')
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
