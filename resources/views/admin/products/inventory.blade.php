@extends('admin.master')

@section('title', 'Inventário Produto')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products/1') }}"><i class="fas fa-boxes"></i> Produtos</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/product/'.$product->id.'/edit') }}"><i class="fas fa-boxes"></i> {{$product->name}}</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/product/'.$product->id.'/inventory') }}"><i class="fas fa-box"></i> Inventário</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<!-- coluna #1 -->
		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fas fa-box"></i> Criar Inventário</h2>
				</div>

				<div class="inside">
					{!! Form::open([ 'url' => '/admin/product/'.$product->id.'/inventory']) !!}
					<label for="name">Nome:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::text('name', null, ['class' => 'form-control']) !!}
					</div>

					<label for="inventory" class="mtop16">Estoque:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::number('inventory', 1, ['class' => 'form-control', 'min' => '1']) !!}
					</div>

					<label for="price" class="mtop16">Preço:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
						{{ config('madecms.currency')}}
						</span>
						{!! Form::number('price', 1.00, ['class' => 'form-control', 'min' => '1', 'step' => 'any']) !!}
					</div>

					<label for="limited" class="mtop16">Limite:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::select('limited', ['0' => 'Limitado', '1' => 'Ilimitado'], 0, ['class' => 'form-select']) !!}
					</div>

					<label for="minimun" class="mtop16">Estoque mínimo:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
						<i class="far fa-keyboard"></i>
						</span>
						{!! Form::number('minimum', 1, ['class' => 'form-control', 'min' => '1']) !!}
					</div>
					{!! Form::submit('Gravar', ['class' => 'btn btn-success mtop16']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

				<!-- columna #2 -->
				<div class="col-md-9">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fas fa-box"></i> Inventarios</h2>
				</div>

				<div class="inside">
					<table class="table">
						<thead>
							<tr>
								<td>ID</td>
								<td>Descrição</td>
								<td>Saldo</td>
								<td>Mínimo</td>
								<td>Preço</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach($product->getInventory as $inventory)
							<tr>
								<td>{{ $inventory->id }}</td>
								<td>{{ $inventory->name }}</td>
								<td>
									@if($inventory->limited == "1")
									Ilimitado
									@else
									{{ $inventory->quantity }}
									@endif
								</td>
								<td>
									@if($inventory->limited == "1")
									Ilimitado
									@else
									{{ $inventory->minimum }}
									@endif
								</td>
								<td>{{ config('madecms.currency') }} {{ $inventory->price }}</td>
								<td width="160">
									<div class="opts">
										<a href="{{ url('/admin/product/inventory/'.$inventory->id.'/edit') }}" data-toggle=
										"tooltip" data-placement="top" title="Editar" class="edit">
											<i class="fas fa-pencil-alt"></i>
										</a>

										<a href="#" data-path="admin/product/inventory" data-action="delete" data-object=
										"{{ $inventory->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn-deleted delete">
											<i class="fas fa-trash-alt"></i>
										</a>
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