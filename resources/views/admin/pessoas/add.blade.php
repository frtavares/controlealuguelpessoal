@extends('admin.master')

@section('title', 'Incluir Pessoa')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/pessoas/1') }}"><i class="fas fa-user-friends"></i> Pessoa</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/pessoa/add') }}"><i class="fas fa-plus"></i> Incluir Pessoa</a>
</li>
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/static/css/select2.min.css?v='.time()) }}">
@endsection


@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<!-- <h2 class="title"><i class="fas fa-plus"></i> Incluir Cliente</h2> -->
		</div>

		<div class="inside">
         {!! Form::open(['url' => '/admin/pessoa/add']) !!} 



         <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Autocomplete from database</h4>
                    <hr>
    
                    <div class="form-group">
                        <label>Product</label>
                        <input id="product_id" name="product_id" type="text" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label>Name</label>
                        <input id="name"  type="text" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label>Buy Rate</label>
                        <input id="matricula"  type="text" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label>Sale Price</label>
                        <input id="sale_price"  type="text" class="form-control">
                    </div>
    
                </div>
            </div>
        </div>
    
        
   




                        <div class="row">
                            <div class="col-md-2">
                                <label for="cpf">CPF</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    
                                    </div>
                                    {!! Form::text('cpf', null, ['class' => 'form-control',
                                     'placeholder' => 'somente números',
                                     'maxlength' => '11',
                                     'name'=>'operador' ,
                                     'id'=>'operador_logica' ] ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-4">
                                <label for="name">Nome completo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    
                                    </div>
                                    {!! Form::text('name', null, ['class' => 'form-control',
                                     'placeholder' => 'nome completo',
                                      'style'=>'text-transform: uppercase;',
                                      'name'=>'loja',
                                       'id'=>'loja_logica'] ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-4">
                                <label for="occupation">Função</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    
                                    </div>
                                    {!! Form::select('occupation', $occs, 0,['class' => 'form-select sel_users1',
                                                                    'placeholder'   => 'selecione']) !!}
                                </div>

                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-1">
                                <label for="matricula">Matrícula/ ID</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    
                                    </div>
                                    {!! Form::text('matricula', null, ['class' => 'form-control'] ) !!}
                                </div>

                            </div>
                        </div>

                       

                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Salvar', ['class' => 'btn btn-success'])!!}
                            </div>
                            {!! Form::hidden('namecpf', null, ['class' => 'form-control']) !!}
                            {!! Form::hidden('userlog', Auth::user()->name .Auth::user()->lastname, ['class' => 'form-control'] ) !!}
                        </div>

                    {!! Form::close()!!}
		</div>
	</div>
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



    