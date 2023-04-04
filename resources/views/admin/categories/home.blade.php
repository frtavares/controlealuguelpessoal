@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/categories/0') }}"><i class="far fa-folder-open"></i> Categorias</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fas fa-plus"></i> Incluir Categoria</h2>
				</div>

				<div class="inside">
					@if(kvfj(Auth::user()->permissions, 'category_add'))
					{!! Form::open(['url' => '/admin/category/add/'.$module, 'files' => true]) !!}
					<label for="name">Nome:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::text('name', null, ['class' => 'form-control']) !!}
					</div>

					<label for="module" class="mtop16">Categoria Pai:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						<select name="parent" class="form-select">
							<option value="0">Sem Categoria Pai</option>
							@foreach($cats as $cat)
							<option value="{{ $cat->id }}">{{ $cat->name }}</option>
							@endforeach
						</select>
					</div>

					<label for="module" class="mtop16">Módulo:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::select('module', getModulesArray(), $module, ['class' => 'form-select', 'disabled']) !!}
					</div>


                    <label for="icon" class="mtop16">Icone:</label>
                    <div class="form-file">
					{!! Form::file('icon', ['class' => 'form-file-input', 'required', 'id' => 'customFile', 'accept' => 'image/*']) !!}
					<label class="form-file-label" for="customFile">
						<span class="form-file-text">Escolha o arquivo...</span>
						<span class="form-file-button">Navegador</span>
					</label>
					</div>

					{!! Form::submit('Gravar', ['class' => 'btn btn-success mtop16']) !!}
					{!! Form::close() !!}
					@endif
				</div>
			</div>
		</div>

		<div class="col-md-9">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="far fa-folder-open"></i> Categorias</h2>
				</div>

				<div class="inside">
					<nav class="nav nav-pills nav-fill">
						@foreach(getModulesArray() as $m => $k)
						<a class="nav-link" href="{{ url('/admin/categories/'.$m) }}"><i class="fas fa-list"></i> {{ $k }}</a>
						@endforeach
					</nav>
					<table class="table mtop16">
						<thead>
							<tr>
                                <td width="64"></td>
                                <td>Nome</td>
                                <td width="160"></td>

							</tr>
						</thead>
						<tbody>
							@foreach($cats as $cat)
							<tr>

                            <td>
                                @if(!is_null($cat->icon))
                                <img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icon) }}" class="img-fluid">
                                @endif
                            </td>
								<td>{{ $cat->name }}</td>
								<td>
									<div class="opts">
										@if(kvfj(Auth::user()->permissions, 'category_edit'))
										<a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
											<i class="fas fa-edit"></i>
										</a>
										<a href="{{ url('/admin/category/'.$cat->id.'/subs') }}" data-toggle="tooltip" data-placement="top" title="Subcategorias">
											<i class="fas fa-list-ul"></i>
										</a>
										@endif
										@if(kvfj(Auth::user()->permissions, 'category_delete'))
										<a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-action="delete" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted">
											<i class="fas fa-trash-alt"></i>
										</a>
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
	</div>
</div>
@endsection
