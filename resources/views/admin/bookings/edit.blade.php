@extends('admin.master')

@section('title', 'Editar Produto')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/bookings/1') }}"><i class="fas fa-boxes"></i> Produtos</a>
</li>
@endsection

@section('css')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://rawgit.com/select2/select2/master/dist/css/select2.min.css" rel="stylesheet" />

<style>
.minha-foto{


    width: 120px;
    height: 240px;

}

</style>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="far fa-edit"></i> Editar Produto</h2>
				</div>

				<div class="inside">
                @if(kvfj(Auth::user()->permissions, 'booking_edit'))
                        {!! Form::open(['url' => '/admin/booking/'.$p->id.'/edit']) !!}




                        <div class="row">
                                <div class="col-md-5">
                                    <label for="cnpj">Booking/ Reserva</label>
                                    <div class="input-group">

                                        {!! Form::text('codigo', $p->codigo,
                                            [
                                                'class'     =>  'form-control',
                                                'style'     =>  'text-transform: uppercase;'
                                            ] )
                                        !!}

                                    </div>
                                </div>
                            </div>


                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="container">Container</label>
                                    <div class="input-group">

                                        {!! Form::text('container', $p->container, ['class' => 'form-control','style'=>'text-transform: uppercase;','maxlength' => '11'] ) !!}

                                    </div>
                                </div>
                            </div>



                        <div class="row mtop16">
                                <div class="col-md-5">
                                    <label for="cnpj">Cliente</label>
                                    <div class="input-group">

                                    {!! Form::select('client',$clis, $p->client_id,
                                        [
                                        'class'         => 'form-select sel_users1',
                                        'placeholder'   => 'selecione'
                                        ])
                                    !!}

                                    </div>
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="col-md-5">
                                    <label for="ship">Navio</label>
                                    <div class="input-group">

                                    {!! Form::select('ship',$ships, $p->ship_id,
                                        [
                                        'class'         => 'form-select sel_users2',
                                        'placeholder'   => 'selecione'
                                        ])
                                    !!}
                                    </div>
                                </div>
                            </div>






                   @endif

                            <div class="row mtop16">
                                <div class="col-md-12">
                                    {!! Form::submit('Alterar', ['class' => 'btn btn-warning'])!!}
                                </div>
                            </div>
                        {!! Form::close()!!}
				</div>
			</div>
		</div>

		<div class="col-md-6">


			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="far fa-images"></i> Galeria</h2>
				</div>
				<div class="inside product_gallery">
					@if(kvfj(Auth::user()->permissions, 'booking_gallery_add'))
					{!! Form::open(['url' => '/admin/booking/'.$p->id.'/gallery/add', 'files' => true, 'id' => 'form_booking_gallery']) !!}
					{!! Form::file('file_image', ['id' => 'booking_file_image', 'accept' => 'image/*', 'style' => 'display: none;', 'required']) !!}
					{!! Form::close() !!}


					<div class="btn-submit">
						<a href="#" id="btn_booking_file_image"><i class="fas fa-camera"></i></a>
					</div>
					@endif

					<div class="tumbs">
						@foreach($p->getGallery as $img)
						<div class="tumb">
							@if(kvfj(Auth::user()->permissions, 'booking_gallery_delete'))
							<a href="{{ url('/admin/booking/'.$p->id.'/gallery/'.$img->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
								<i class="fas fa-trash-alt"></i>
							</a>
							@endif
							<img class="minha-foto" src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }}">
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection



@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ url('/static/js/select2.min.js?v='.time()) }}"></script>
<script src="{{ url('/static/js/admin.js?v='.time()) }}"></script>



<script type="text/javascript">
$(document).ready(function(){

  // Initialize Select2
  $('.sel_users1').select2();
  $('.sel_users2').select2();
  $('.sel_users3').select2();
  $('.sel_users4').select2();
  $('.sel_users5').select2();
  $('.sel_users6').select2();


  // Set option selected onchange
  $('.user_selected').change(function(){
    var value = $(this).val();

    // Set selected
    $('.sel_users1').val(value);
    $('.sel_users1').select2().trigger('change');

    $('.sel_users2').val(value);
    $('.sel_users2').select2().trigger('change');

    $('.sel_users3').val(value);
    $('.sel_users3').select2().trigger('change');

    $('.sel_users4').val(value);
    $('.sel_users4').select2().trigger('change');

    $('.sel_users5').val(value);
    $('.sel_users5').select2().trigger('change');

    $('.sel_users6').val(value);
    $('.sel_users6').select2().trigger('change');

});
});

</script>


<script>
$('#myCollapsible').collapse({
toggle: true
})
</script>
@endsection

