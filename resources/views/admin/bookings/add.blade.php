@extends('admin.master')

@section('title', 'Incluir Ovação')

@section('breadcrumb')
<ol class="breadcrumb-item">
    <a href="{{ url('/admin/bookings/1') }}"><i class="fas fa-cube"></i> Ovação</a>
</ol>
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/static/css/select2.min.css?v='.time()) }}">
@endsection

@section('content')
<div class="container-fluid mtop16">
	<div class="panel shadow">
		

		<div class="inside">

                    @if(kvfj(Auth::user()->permissions, 'booking_add'))
            {!! Form::open(['url' => '/admin/booking/add']) !!}


                        

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="cnpj">Booking/ Reserva</label>
                                    <div class="input-group">
                                    
                                        {!! Form::text('codigo', null, ['class' => 'form-control','style'=>'text-transform: uppercase;'] ) !!}

                                    </div>
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="container">Container</label>
                                    <div class="input-group">
                                    
                                        {!! Form::text('container', null, ['class' => 'form-control','style'=>'text-transform: uppercase;','maxlength' => '11'] ) !!}

                                    </div>
                                </div>
                            </div>


                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="cnpj">Cliente</label>
                                    <div class="input-group">
                                    
                                    {!! Form::select('client', $clis, 0, ['class' => 'form-select sel_users1',
                                                                    'placeholder'   => 'selecione']) !!}

                                    </div>
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="ship">Navio</label>
                                    <div class="input-group">
                                    
                                    {!! Form::select('ship', $ships, 0, ['class' => 'form-select sel_users2',
                                                                    'placeholder'   => 'selecione']) !!}

                                    </div>
                                </div>
                            </div>

                        @endif

                            <div class="row mtop16">
                                <div class="col-md-12">
                                    {!! Form::submit('Salvar', ['class' => 'btn btn-success'])!!}
                                    {!! Form::hidden('userlog', Auth::user()->name .Auth::user()->lastname, ['class' => 'form-control'] ) !!}
                                </div>
                            </div>

                </div>

                

            {!! Form::close()!!}

                  
            </div>
@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="{{ url('/static/js/select2.min.js?v='.time()) }}"></script>


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


@endsection

