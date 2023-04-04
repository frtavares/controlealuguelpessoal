@extends('admin.master')

@section('title', 'Editar Produto')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products/1') }}"><i class="fas fa-boxes"></i> Produtos</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="far fa-edit"></i> Editar Produto</h2>
				</div>

				<div class="inside">
					{!! Form::open(['url' => '/admin/product/'.$p->id.'/edit', 'files' => true]) !!}
					
					<div class="row">

						<div class="col-md-12">
							<label for="name">Descrição do produto:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::text('name', $p->name, ['class' => 'form-control']) !!}
							</div>
						</div>

					</div>

					<div class="row mtop16">
						<div class="col-md-6">
							<label for="category">Categoria Pai:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::select('category', $cats, $p->category_id, ['class' => 'form-select', 'id' => 'category']) !!}
								{!! Form::hidden('subcategory_actual', $p->subcategory_id, ['id' => 'subcategory_actual']) !!}
							</div>
						</div>

						<div class="col-md-6">
							<label for="category">Subcategoria:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::select('subcategory', [], $p->subcategory_id, ['class' => 'form-select', 'id' => 'subcategory', 'required']) !!}
							</div>
						</div>

						
					</div>

					<div class="row mtop16">
						<div class="col-md-3">
							<label for="price">Preço:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::number('price', $p->price, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
							</div>
							
						</div>

						<div class="col-md-3">
							<label for="indiscount">Desconto ?:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->in_discount, ['class' => 'form-select']) !!}
							</div>
						</div>

						<div class="col-md-3">
							<label for="discount">Desconto:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::number('discount', $p->discount, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
							</div>
						</div>

						<div class="col-md-3">
							<label for="name">Imagem em Destaque:</label>
							<div class="form-file">
							{!! Form::file('img', ['class' => 'form-file-input', 'id' => 'customFile', 'accept' => 'image/*']) !!}
							<label class="form-file-label" for="customFile">
								<span class="form-file-text">Selecione...</span>
								<span class="form-file-button">Pasta</span>
							</label>
							</div>
						</div>

					</div>

					<div class="row mtop16">
						<div class="col-md-3">
							<label for="inventory">Inventário:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::number('inventory', $p->inventory, ['class' => 'form-control', 'min' => '0.00']) !!}
							</div>
						</div>

						<div class="col-md-3">
							<label for="code">Codígo de sistema:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::text('code', $p->code, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="col-md-3">
							<label for="indiscount">Situação:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::select('status', ['0' => 'Inativo', '1' => 'Publico'], $p->status, ['class' => 'form-select']) !!}
							</div>
						</div>
					</div>

					<div class="row mtop16">
						<div class="col-md-12">
							<label for="content">Detalhes do produto</label>
							{!! Form::textarea('content', $p->content, ['class' => 'form-control', 'id' => 'editor']) !!}
						</div>
					</div>

					<div class="row mtop16">
						<div class="col-md-12">
							{!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
						</div>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="far fa-image"></i> Imagen Destacada</h2>
					<div class="inside">
						<img src="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" class="img-fluid">
					</div>
				</div>
			</div>

			<div class="panel shadow mtop16">
				<div class="header">
					<h2 class="title"><i class="far fa-images"></i> Galeria</h2>
				</div>
				<div class="inside product_gallery">
					@if(kvfj(Auth::user()->permissions, 'product_gallery_add'))
					{!! Form::open(['url' => '/admin/product/'.$p->id.'/gallery/add', 'files' => true, 'id' => 'form_product_gallery']) !!}
					{!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'style' => 'display: none;', 'required']) !!}
					{!! Form::close() !!}


					<div class="btn-submit">
						<a href="#" id="btn_product_file_image"><i class="fas fa-plus"></i></a>
					</div>
					@endif

					<div class="tumbs">
						@foreach($p->getGallery as $img)
						<div class="tumb">
							@if(kvfj(Auth::user()->permissions, 'product_gallery_delete'))
							<a href="{{ url('/admin/product/'.$p->id.'/gallery/'.$img->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
								<i class="fas fa-trash-alt"></i>
							</a>
							@endif
							<img src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }}">
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection