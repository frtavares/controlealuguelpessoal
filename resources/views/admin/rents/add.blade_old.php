@extends('admin.master')
@section('title', 'Faturamento Locação')

@section('content')

@section('breadcrumb')
    <ol class="breadcrumb-item">
        <a href="{{ url('/admin/rents/1') }}"><i class="fas fa-list"></i> Faturamento Locação</a>
    </ol>
@endsection



<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container-fluid">

       

            @if (kvfj(Auth::user()->permissions, 'rent_add'))
                {!! Form::open(['url' => '/admin/rent/add', 'onkeydown' => 'EnterKeyFilter();']) !!}

                <div class="row">

                    <div class="col-md-12">
                        <label for="booking">Locador</label>
                        <div class="input-group">

                            {!! Form::select('client', $clis, null, [
                                                'class' => 'form-control teste',
                                                'style' => 'max-height: 100% !important;',
                                                'placeholder' => 'Selecione',
                                            ]) !!}
                        </div>
                    </div>

                </div>

                <div class="row mtop16">
                    <div class="col-md-2">
                        <label for="referencia">Mês Referencia:</label>
                        <div class="input-group">
                            {!! Form::select('mes', $mesess, null, ['class' => 'form-control']) !!}

                        </div>
                    </div>


                            {!! Form::hidden('ano', 0, ['class' => 'form-control']) !!}

                           

                    <div class="col-md-2">
                        <label for="placa">Vencimento:</label>
                        <div class="input-group">
                            {!! Form::date('vencimento', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="valor">Valor:</label>
                        <div class="input-group">

                            {!! Form::number('valor', Config::get('madecms.valor_locador'), ['class' => 'form-control', 'id' => 'valor1', 'step' => 'any', 'readonly' => 'readonly']) !!}

                            <!-- {!! Form::text('valor', null, [
                                                'class' => 'form-control',
                                                'id' => 'valor1',
                                                'step' => 'any',
                                            ]) !!} -->
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="condominio">Valor Condomínio:</label>
                        <div class="input-group">
                            {!! Form::number('condominio', null, [
                                            'class' => 'form-control',
                                            'id' => 'valor3',
                                            'step' => 'any',
                                        ]) !!}
                        </div>
                    </div>

                </div>

                <div class="row mtop16">

                    <div class="col-md-2">
                        <label for="taxaextra">Extra Condomínio:</label>
                        <div class="input-group">
                            {!! Form::number('taxaextra', 0, [
                                                'class' => 'form-control',
                                                'id' => 'valor4',
                                                'step' => 'any',
                                            ]) !!}
                        </div>
                    </div>
                    {!! Form::hidden('referenciataxa', 'TAXA EXTRA CONDOMÍNIO', ['class' => 'form-control', 'maxlength' => '50', 'style' => 'text-transform: uppercase;']) !!}


                    <div class="col-md-2">
                        <label for="taxaincendio">Taxa Incêndio:</label>
                        <div class="input-group">
                            {!! Form::number('taxaincendio', 0, [
                                                'class' => 'form-control',
                                                'id' => 'valor5',
                                                'step' => 'any',
                                            ]) !!}
                        </div>
                    </div>
                    {!! Form::hidden('referenciataxaincendio', 'TAXA INCÊNDIO REF', ['class' => 'form-control', 'maxlength' => '50', 'style' => 'text-transform: uppercase;']) !!}


                    <div class="col-md-2">
                        <label for="iptu">IPTU:</label>
                        <div class="input-group">
                            {!! Form::number('iptu', 0, [
                                                'class' => 'form-control',
                                                'id' => 'valor6',
                                                'step' => 'any',
                                            ]) !!}
                        </div>
                    </div>
                    {!! Form::hidden('referenciaiptu', 'IPTU REF', ['class' => 'form-control', 'maxlength' => '50', 'style' => 'text-transform: uppercase;']) !!}



                    <div class="col-md-2">
                        <label for="desconto">Desconto:</label>
                        <div class="input-group">
                            {!! Form::number('desconto', 0, [
                                                'class' => 'form-control',
                                                'id' => 'valor2',
                                                'step' => 'any',
                                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="referenciadesconto">Motivo Desconto:</label>
                        <div class="input-group">
                            {!! Form::text('referenciadesconto', 'DESCONTO', ['class' => 'form-control', 'maxlength' => '20', 'style' => 'text-transform: uppercase;']) !!}
                        </div>
                    </div>

                </div>

                <div class="row mtop16">

                    <div class="col-md-2 ">
                        <label for="subtotal">Subtotal:</label>
                        <div class="input-group">
                            {!! Form::number('subtotal', null, [
                                            'class' => 'form-control',
                                            'id' => 'result',
                                            'step' => 'any',
                                            'readonly' => 'readonly',
                                            'onblur' => 'calcular()',
                                        ]) !!}
                        </div>
                    </div>


                    <div class="col-md-2 ">
                        <label for="total">Total:</label>
                        <div class="input-group">
                            {!! Form::number('total', null, [
                                            'class' => 'form-control',
                                            'id' => 'resultado',
                                            'step' => 'any',
                                            'readonly' => 'readonly',
                                        ]) !!}
                        </div>
                    </div>


                    


                    <div class="col-md-4">
                        <label for="observacoes">Observações:</label>
                        <div class="input-group">
                            {!! Form::text('observacoes', '**********************************', ['class' => 'form-control', 'maxlength' => '100', 'style' => 'text-transform: uppercase;']) !!}
                        </div>
                    </div>


                    <div class="col-md-2">
                        <label for="referencia">Referencia:</label>
                        <div class="input-group">
                            {!! Form::select('referencia', $pendenciass, null, ['class' => 'form-control']) !!}

                        </div>
                    </div>

                   
                </div>


                <div class="mtop16">
                    {!! Form::submit('Gravar', ['class' => 'btn btn-success']) !!}

                    {!! Form::hidden('userlog', Auth::user()->name . Auth::user()->lastname, ['class' => 'form-control']) !!}
                </div>

        
        @endif

        <div class="col-md-2">
            <label for="referencia">Mês Referencia:</label>
            <div class="input-group">
                {!! Form::select('mes', $mesess, null, ['class' => 'form-control']) !!}

            </div>
        </div>
        
        {!! Form::close() !!}

   
</div>
</div>
   
</div>  
</div>

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script> --}}
    {{-- <script src="https://rawgit.com/select2/select2/master/dist/js/select2.js"></script>

    <script src="/lib/jquery-1.12.2.min.js"></script>
    <script src="/lib/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> --}}


    <script>
         $(document).ready(function() {
        $(".datepicker").datepicker( {
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months"
      });
    });
    <script>



        $(document).ready(function() {
            /*disable non active tabs*/
            $('.nav li').not('.active').addClass('disabled');
            $('.nav li').not('.active').find('a').removeAttr("data-toggle");

            $('button.next').click(function() {
                /*enable next tab*/
                $('.nav li.active').next('li').removeClass('disabled');
                $('.nav li.active').next('li').find('a').attr("data-toggle", "tab").trigger("click");
            });

            $('button.prev').click(function() {
                $('.nav li.active').prev('li').find('a').trigger("click");
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.teste').select2();

        });
    </script>

    <style>
        .select2-selection__rendered {
            line-height: 31px !important;
        }

        .select2-container .select2-selection--single {
            height: 35px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }
    </style>




    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('input').on('keyup', function() {
                if (jQuery(this).attr('name') === 'result') {
                    return false;
                }
                var valor1 = (jQuery('#valorl').val() == '' ? 0 : jQuery('#valor1').val());
                var valor2 = (jQuery('#valor2').val() == '' ? 0 : jQuery('#valor2').val());
                var valor3 = (jQuery('#valor3').val() == '' ? 0 : jQuery('#valor3').val());
                var valor4 = (jQuery('#valor4').val() == '' ? 0 : jQuery('#valor4').val());
                var valor5 = (jQuery('#valor5').val() == '' ? 0 : jQuery('#valor5').val());
                var valor6 = (jQuery('#valor6').val() == '' ? 0 : jQuery('#valor6').val());


                var result = (parseFloat(valor1) + parseFloat(valor3) + parseFloat(valor4) + parseFloat(
                    valor5) + parseFloat(valor6));
                jQuery('#result').val(parseFloat(result));

            });
        });
    </script>


    <script type="text/javascript">
        function calcular() {
            var valor2 = parseFloat(document.getElementById('valor2').value, 10);
            var result = parseFloat(document.getElementById('result').value, 10);
            document.getElementById('resultado').value = parseFloat(result) - parseFloat(valor2);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#data").mask("00/00/0000");
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                format: "yy",
                weekStart: 0,
                calendarWeeks: false,
                autoclose: true,
                todayHighlight: true,
                rtl: true,
                orientation: "auto"
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            function yearList() {
                let year = document.getElementById('#ano') //busca o elemento HTML com o id "ano"
                for (let i = 1900; i <
                    2022; i++) { //loop contendo o ano inicial e final que deverão constar no input select
                    let option = document.createElement("option") //cria um elemento "option" na variável option
                    option.value = i //atribui o valor do índice ao value do option
                    option.text = i //atribui o valor do índice ao text do option
                    year.appendChild(
                        option) //cria um option como "filho" para o select, contendo o value e o text equivalentesao index atual
                }
            }
            yearList()
        });
    </script>

    <script>
        $(document).ready(function() {
            function changeElement(data) {
                var element = $('#checkfor');
                element.val(data.Inativo); // Aqui você configura o valor

                // Com o valor já atribuído, você faz as modificações
                if (element.val() == 1) {
                    element.prop('checked', true);
                } else if (element.val() == 0) {
                    element.prop('checked', false);
                }
            }

        });
    </script>



    <script>
        $(document).ready(function() {
            $('input').keypress(function(e) {
                var code = null;
                code = (e.keyCode ? e.keyCode : e.which);
                return (code == 13) ? false : true;
            });
        });
    </script>




@endsection



@endsection
