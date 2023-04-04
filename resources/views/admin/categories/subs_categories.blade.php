@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/categories/0') }}"><i class="far fa-folder-open"></i> Categorias</a>
</li>
<li class="breadcrumb-item">
	<a href="#"><i class="far fa-folder-open"></i> Categoria: {{ $category->name }}</a>
</li>
<li class="breadcrumb-item">
	<a href="#"><i class="far fa-folder-open"></i> Sub Categoria</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-12">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="far fa-folder-open"></i> Sub Categorias de <strong>{{$category->name}}</strong></h2>
				</div>

				<div class="inside">
					
					<table class="table mtop16">
						<thead>
							<tr>
                                <td width="64"></td>
                                <td>Nome</td>
                                <td width="160"></td>

							</tr>
						</thead>
						<tbody>
							@foreach($category->getSubcategories as $cat)
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
