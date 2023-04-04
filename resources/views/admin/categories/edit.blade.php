@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/categories/0') }}"><i class="far fa-folder-open"></i> Categorias</a>
</li>
@if($cat->parent != "0")
<li class="breadcrumb-item">
	<a href="{{ url('/admin/category/'.$cat->parent.'/subs') }}"><i class="far fa-folder-open"></i> {{ $cat->getParent->name }}</a>
</li>
@endif
<li class="breadcrumb-item">
	<a href="{{ url('/admin/category/'.$cat->id.'/edit') }}"><i class="far fa-folder-open"></i> Editando {{ $cat->name }}</a>
</li>


@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fas fa-edit"></i> Editar Categoria</h2>
				</div>

				<div class="inside">
					{!! Form::open(['url' => '/admin/category/'.$cat->id.'/edit', 'files' => true]) !!}
					<label for="name">Nome:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
					</div>
					
                    <label for="icon" class="mtop16">Icone:</label>
                    <div class="form-file">
					{!! Form::file('icon', ['class' => 'form-file-input','id' => 'customFile', 'accept' => 'image/*']) !!}
					<label class="form-file-label" for="customFile">
						<span class="form-file-text">Choose file...</span>
						<span class="form-file-button">Browse</span>
					</label>
					</div>

					<label for="order" class="mtop16">Ordem:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::number('order', $cat->order, ['class' => 'form-control']) !!}
					</div>


					{!! Form::submit('Gravar', ['class' => 'btn btn-success mtop16']) !!}
					{!! Form::close() !!}
				</div>
			</div>
        </div>

        @if(!is_null($cat->icon))
        <div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fas fa-edit"></i> Ícone atual</h2>
				</div>

				<div class="inside">
					<img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icon) }}" class="img-fluid">
				</div>
			</div>
        </div>
        @endif
	</div>
</div>
@endsection
