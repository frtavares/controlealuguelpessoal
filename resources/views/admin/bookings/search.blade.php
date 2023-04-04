@extends('admin.master')

@section('title', 'Ovação')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/bookings/1') }}"><i class="fas fa-cube"></i> Ovação</a>
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
                @if(kvfj(Auth::user()->permissions, 'booking_add'))
                <li >
                    <a href="{{ url('/admin/booking/add') }}">
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
                        <li><a href="{{ url('/admin/bookings/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
                        <li><a href="{{ url('/admin/bookings/0') }}"><i class="fas fa-eraser" ></i> Inativo</a></li>
                        <li><a href="{{ url('/admin/bookings/trash') }}"><i class="fas fa-trash"></i> Lixeira</a></li>
                        <li><a href="{{ url('/admin/bookings/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
                    </ul>
                </li>
            </ul>
		</div>

		<div class="inside">

			<div class="form_search" id="form_search">
				{!! Form::open(['url' => '/admin/booking/search']) !!}
				<div class="row">
					<div class="col-md-4">
						{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquise aqui', 'required']) !!}
					</div>
					<div class="col-md-4">
						{!! Form::select('filter', ['0' => 'Container', '1' => 'Booking'], 0, ['class' => 'form-select']) !!}
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
						<td>Data</td>
                        <td>Container</td>
                        <td>Booking/ Reserva</td>

                        <td>Ações</td>
					</tr>
				</thead>
				<tbody>
					@foreach($bookings as $p)
					<tr>
					    <td>{{ date( 'd/m/Y H:i:s' , strtotime($p->entrada))}}</td>
                        <td>{{ $p->container }}</td>
                        <td>{{ $p->codigo }}</td>

						<td width="200">
							<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'booking_edit'))
								<a href="{{ url('/admin/booking/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit mtop16">
									<i class="fas fa-edit fa-2x"></i>
								</a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'booking_pdf'))
                                    <a class="inventory mtop16" href="{{ url('/admin/bookings/'.$p->id.'/pdf') }}" data-toggle="tooltip" data-placement="top" title="Imprimir documento">
                                        <i class="fa fa-file-pdf-o fa-2x"></i>
                                    </a>

                                @endif
                                 @if(kvfj(Auth::user()->permissions, 'booking_gallery'))
                                    <a  class="image mtop16 gallery" href="{{ url('/admin/bookings/'.$p->id.'/gallery') }}" data-toggle="tooltip" data-placement="top" title="Galeria de fotos">
                                        <i class="fas fa-images fa-2x"></i>
                                    </a>

                                @endif
								@if(kvfj(Auth::user()->permissions, 'booking_delete'))
									@if(is_null($p->deleted_at))
									<a href="" data-path="admin/booking" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted delete mtop16">
										<i class="fas fa-trash-alt fa-2x"></i>
									</a>
									@else
									<a href="{{ url('/admin/booking/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/booking" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore mtop16">
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
