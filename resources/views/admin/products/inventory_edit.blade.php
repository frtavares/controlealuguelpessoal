@extends('admin.master')

@section('title', 'Inventário Produto')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products/1') }}"><i class="fas fa-boxes"></i> Produtos</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/product/'.$inventory->getProduct->id.'/edit') }}"><i class="fas fa-boxes"></i> {{$inventory->getProduct->name}}</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/product/'.$inventory->product_id.'/inventory') }}"><i class="fas fa-box"></i> Inventário</a>
</li>

<li class="breadcrumb-item">
	<a href="{{ url('/admin/product/inventory'.$inventory->id.'/edit') }}"><i class="fas fa-box"></i> {{$inventory->name}}</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<!-- coluna #1 -->
		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fas fa-box"></i> Editar Inventário</h2>
				</div>

				<div class="inside">
					{!! Form::open([ 'url' => '/admin/product/inventory/'.$inventory->id.'/edit']) !!}
					<label for="name">Nome:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::text('name', $inventory->name, ['class' => 'form-control']) !!}
					</div>

					<label for="inventory" class="mtop16">Estoque:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::number('inventory', $inventory->quantity, ['class' => 'form-control', 'min' => '1']) !!}
					</div>

					<label for="price" class="mtop16">Preço:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
						{{ config('madecms.currency')}}
						</span>
						{!! Form::number('price', $inventory->price, ['class' => 'form-control', 'min' => '1', 'step' => 'any']) !!}
					</div>

					<label for="limited" class="mtop16">Limite:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						</span>
						{!! Form::select('limited', ['0' => 'Limitado', '1' => 'Ilimitado'], $inventory->limited, ['class' => 'form-select']) !!}
					</div>

					<label for="minimun" class="mtop16">Estoque mínimo:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
						<i class="far fa-keyboard"></i>
						</span>
						{!! Form::number('minimum', $inventory->minimum, ['class' => 'form-control', 'min' => '1']) !!}
					</div>
					{!! Form::submit('Gravar Alteração', ['class' => 'btn btn-warning mtop16']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

				<!-- columna #2 -->
		<div class="col-md-9">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fas fa-box"></i> Variação/ SKU</h2>
				</div>

				<div class="inside">
				{!! Form::open([ 'url' => '/admin/product/inventory/'.$inventory->id.'/variant']) !!}
					<div class="row">
					
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="far fa-keyboard"></i>
								</span>
								{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome da variação']) !!}
							</div>
						</div>
						<div class="col-md-4">
						{!! Form::submit('Gravar', ['class' => 'btn btn-success']) !!}
						</div>
					
					</div>
					{!! Form::close() !!}
					<hr>
08:27
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
							


						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection