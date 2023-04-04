@extends('admin.master')

@section('title', 'Incluir Capa de Lote')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/capas/1') }}"><i class="fas fa-list"></i> Capa de Lote</a>
</li>
<li class="breadcrumb-item">
    <a href="#"><i class="fas fa-edit"></i> Incluir Capa de Lote</a>
</li>
@endsection

@section('css')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://rawgit.com/select2/select2/master/dist/css/select2.min.css" rel="stylesheet" />

  
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel shadow">
                <div class="header">
                    <!-- <h2 class="title"><i class="far fa-edit"></i> Editar Produto</h2> -->
                </div>

             
               
                    <ul class="nav nav-pills">
                    <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                    <li><a href="#profile" data-toggle="tab">Profile</a></li>
                    <li><a href="#messages" data-toggle="tab">Messages</a></li>
                    </ul>

                    <div id='content' class="tab-content">
                        <div class="tab-pane active" id="home">
                            Nome: <input/><br/>
                            {!! Form::button('Salvar Registro', ['class' => 'btn btn-success next'])!!}
                            <button class="next">Próximo</button>
                        </div>
                        <div class="tab-pane" id="profile">
                            CPF: <input/><br/>
                            <button class="prev">Anterior</button>
                            <button class="next">Próximo</button>
                        </div>
                        <div class="tab-pane" id="messages">
                            <button class="prev">Anterior</button>
                            <button class="save">Salvar</button>
                        </div>
                    </div>


                <div class="inside">
                @if(kvfj(Auth::user()->permissions, 'capa_add'))
                {!! Form::open(['url' => '/admin/capa/add']) !!}



               

                    <fieldset>
                   <legend class="mtop16" style="color:blue;"><h6 style="font-weight:bold;">Dados do Container</h6></legend>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="dataservico">Data Entrada:</label>
                                    <div class="input-group">
                                    {!! Form::date('dataservico', null, [ 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="booking">Booking</label>
                                        <div class="input-group">
                                        {!! Form::text('booking', null, ['class' => 'form-control','maxlength' => '40', 'style'=>'text-transform: uppercase;'] ) !!}
                                        </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="code">Nº Container:</label>
                                    <div class="input-group">
                                    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => '11', 'style'=>'text-transform: uppercase;height:15px;'] ) !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="iso">Tipo/ ISO</label>
                                    <div class="input-group">
                                    {!! Form::select('iso',$isoss,null,
                                        [
                                        'class' => 'form-select sel_users1',
                                    'style' => 'height-max:260px !important;',
                                        'placeholder' => 'selecione'
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="lacre">1º Lacre:</label>
                                    <div class="input-group">
                                    {!! Form::text('lacre', null, ['class' => 'form-control','maxlength' => '50', 'style'=>'text-transform: uppercase;'] ) !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="lacre2">2º Lacre:</label>
                                    <div class="input-group">
                                    {!! Form::text('lacre2', null, ['class' => 'form-control','maxlength' => '50', 'style'=>'text-transform: uppercase;'] ) !!}
                                    </div>
                                </div>
                            </div>

                   </fieldset>





                    <legend class="mtop16" style="color:blue;"><h6 style="font-weight:bold;">Dados do Cliente</h6></legend>
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="client">Exportador</label>
                                    <div class="input-group">
                                    {!! Form::select('client',$clis, null,
                                        [
                                        'class' => 'form-select sel_users3',

                                        'placeholder' => 'selecione'
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="navio">Navio</label>
                                    <div class="input-group">

                                    {!! Form::select('navio', $ships, null,
                                        [
                                            'class' => 'form-control sel_users7',
                                            'placeholder' => 'selecione',
                                             'style'=>'text-transform: uppercase;'
                                        ]) !!}
                                    </div>
                                </div>

                            </div>




                 <legend class="mtop16" style="color:blue;"><h6 style="font-weight:bold;">Transportador</h6></legend>
                        <div class="row">

                            <div class="col-md-4">
                                <label for="transportador">Transportadora</label>
                                <div class="input-group">
                                {!! Form::select('transportadora', $trans,null,
                                        [
                                        'class' => 'form-select sel_users5',

                                        'placeholder' => 'selecione'
                                        ]) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="pessoa">Motorista</label>
                                <div class="input-group">
                                {!! Form::select('pessoa', $pess, null,
                                [
                                'class' => 'form-select sel_users6',
                                'placeholder'   => 'selecione'
                                ]) !!}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="placa">Placa Cavalo:</label>
                                <div class="input-group">
                                {!! Form::text('placa', null, ['class' => 'form-control','maxlength' => '7', 'style'=>'text-transform: uppercase;'] ) !!}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="placa2">Placa Carreta:</label>
                                <div class="input-group">
                                {!! Form::text('placa2', null, ['class' => 'form-control','maxlength' => '7', 'style'=>'text-transform: uppercase;'] ) !!}
                                </div>
                            </div>
                        </div>



                       <legend class="mtop16" style="color:blue;"><h6 style="font-weight:bold;">Dados da Pesagem</h6></legend>
                            <div class="row">
                            <div class="col-md-2">
                                <label for="tara">Tara:</label>
                                <div class="input-group">
                                {!! Form::text('tara',null, [
                                'class' => 'form-control',
                                'id'=>'valor3',
                                'step'=>'any'
                                ] ) !!}
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <label for="pesoentrada">Peso Entrada:</label>
                                <div class="input-group">
                                {!! Form::text('pesoentrada',null, [
                                'class' => 'form-control',
                                'id'=>'valor1',
                                'step'=>'any'
                                ] ) !!}
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <label for="pesovazio">Peso Vazio:</label>
                                <div class="input-group">
                                {!! Form::number('pesovazio',null, [
                                'class' => 'form-control',
                                'id'=>'valor2',
                                'step'=>'any'
                                ] ) !!}
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <label for="pesocarga">Peso da Líquido Carga:</label>
                                <div class="input-group">
                                {!! Form::number('pesocarga',null, [
                                'class' => 'form-control',
                                'id'=>'result',
                                'step'=>'any',
                                'readonly'=> 'readonly',
                                'onblur' => 'calcular()'
                                ] ) !!}
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <label for="pesobruto">Peso Bruto:</label>
                                <div class="input-group">
                                {!! Form::number('pesobruto',null, [
                                'class' => 'form-control',
                                'id'=>'resultado',
                                'step'=>'any',
                                'readonly'=> 'readonly',
                                'onblur' => 'calcular()' ] ) !!}
                                </div>
                            </div>

                        </div>


                 <legend class="mtop16" style="color:blue;"><h6 style="font-weight:bold;">Documentos/ Descrição</h6></legend>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="danfe">Nota fiscal:</label>
                                <div class="input-group">
                                {!! Form::text('danfe', null, ['class' => 'form-control','maxlength' => '20', 'style'=>'text-transform: uppercase;'] ) !!}
                                </div>
                            </div>

                            <div class="col-md-10">
                                <label for="carga">Descrição Carga:</label>
                                <div class="input-group">
                                {!! Form::text('carga', null, ['class' => 'form-control','maxlength' => '20', 'style'=>'text-transform: uppercase;'] ) !!}
                                </div>
                            </div>
                        </div>



            @endif


                    <div class="row">
                        <div class="col-md-12 mtop16">
                            {!! Form::submit('Salvar Registro', ['class' => 'btn btn-success'])!!}

                            {!! Form::hidden('userlog', Auth::user()->name .Auth::user()->lastname, ['class' => 'form-control'] ) !!}
                        </div>

                    </div>

        {!! Form::close()!!}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="https://rawgit.com/select2/select2/master/dist/js/select2.js"></script>

<script src="/lib/jquery-1.12.2.min.js"></script>
  <script src="/lib/bootstrap.min.js"></script>

<script>
   $(document).ready(function() {
    /*disable non active tabs*/
    $('.nav li').not('.active').addClass('disabled');
    $('.nav li').not('.active').find('a').removeAttr("data-toggle");

    $('button.next').click(function(){
        /*enable next tab*/
        $('.nav li.active').next('li').removeClass('disabled');
        $('.nav li.active').next('li').find('a').attr("data-toggle","tab").trigger("click");
    });

    $('button.prev').click(function() {
        $('.nav li.active').prev('li').find('a').trigger("click");
    });
});
</script>


<script type="text/javascript">
$(document).ready(function(){

  // Initialize Select2
  $('.sel_users1').select2();
  $('.sel_users2').select2();
  $('.sel_users3').select2();
  $('.sel_users4').select2();
  $('.sel_users5').select2();
  $('.sel_users6').select2();
  $('.sel_users7').select2();



  // Set option selected onchange
  $('.user_selected').change(function(){
    var value = $(this).val();
    var OptionSize = $(this).find("option").size(30);
    var HeightPerOption = 36;
    var DropDownHeight = OptionSize * HeightPerOption;
    // Set selected
    $('.sel_users1').val(value);
    //$('.sel_users1 select').css('height', '100px');
    $('.sel_users1').select2().trigger('change');
    $('.sel_users1').select2().height(DropDownHeight);

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

    $('.sel_users7').val(value);
    $('.sel_users7').select2().trigger('change');

});
});
</script>


<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('input').on('keyup',function(){
if(jQuery(this).attr('name') === 'result'){
return false;
}
var valor1 = (jQuery('#valor1').val() == '' ? 0 : jQuery('#valor1').val());
var valor2 = (jQuery('#valor2').val() == '' ? 0 : jQuery('#valor2').val());
var valor3 = (jQuery('#valor3').val() == '' ? 0 : jQuery('#valor3').val());

var result = (parseFloat(valor1) - parseFloat(valor2) - parseFloat(valor3));
jQuery('#result').val(parseFloat(result));

});
});
</script>


<script type="text/javascript">
function calcular() {
var valor3 = parseInt(document.getElementById('valor3').value, 10);
var result = parseInt(document.getElementById('result').value, 10);
document.getElementById('resultado').value = valor3 + result;
}
</script>

<script type="text/javascript">

$(document).ready(function(){
$("#data").mask("00/00/0000");
});

</script>
@endsection
