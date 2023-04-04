@extends('admin.master')

@section('title', 'Configuração')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/settings') }}"><i class="fas fa-cogs"></i> Configuração</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
{!! Form::open(['url' => '/admin/settings']) !!}
    <div class="row">
        <div class="col-md-12">

            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-cogs"></i> Locador</h2>
                </div>
                <div class="inside">

                    <div class="row">
                        <div class="col-md-2">
                            <label for="cnpj">CNPJ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <!-- , 'onblur' => 'checkCnpj(this.value)' -->
                                </div>
                                {!! Form::text('cnpj', Config::get('madecms.cnpj'), ['class' => 'form-control' ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="name">Razão Social</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('name', Config::get('madecms.name'), ['class' => 'form-control'
                                        ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="name">Banco</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('banco', Config::get('madecms.banco'), ['class' => 'form-control'
                                        ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="name">Agência</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('agencia', Config::get('madecms.agencia'), ['class' => 'form-control'
                                        ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="name">Conta</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('conta', Config::get('madecms.conta'), ['class' => 'form-control'
                                        ] ) !!}
                            </div>
                        </div>

                        
                    </div>



                    <div class="row mtop16">
                        <div class="col-md-2">
                            <label for="cep">CEP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('cep', Config::get('madecms.cep'), ['class' => 'form-control', 'id' => 'cep','onblur' => 'cep(this.value)'] ) !!}
                            </div>
                        </div>
                        
                      

                        <div class="col-md-5">
                            <label for="logradouro">Endereço</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('logradouro', Config::get('madecms.logradouro'), ['class' => 'form-control',
                                    'id' => 'rua','readonly'=> 'readonly' ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="numero">Número</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('numero', Config::get('madecms.numero'), ['class' => 'form-control'
                                         ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="complemento">Complemto:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('complemento', Config::get('madecms.complemento'), ['class' => 'form-control', 'id' => 'complemento', 'style'=>'text-transform: uppercase;'] ) !!}
                            </div>
                        </div>
                    </div>


                    <div class="row mtop16">
                        <div class="col-md-4">
                            <label for="bairro">Bairro:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('bairro', Config::get('madecms.bairro'), ['class' => 'form-control', 'id' => 'bairro',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="municipio">Município:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('municipio', Config::get('madecms.municipio'), ['class' => 'form-control', 'id' => 'cidade',
                                         'readonly'=> ''] ) !!}
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label for="uf">UF:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('uf', Config::get('madecms.uf'), ['class' => 'form-control', 'id' => 'uf',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="company_phone">Telefone:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('company_phone', Config::get('madecms.company_phone'), ['class' => 'form-control'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="email">E-mail:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('email', Config::get('madecms.email'), ['class' => 'form-control', 'id' => 'email'] ) !!}
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>




            
            <div class="panel shadow mtop16">
                <div class="header">
                    <h2 class="title"><i class="fas fa-cogs"></i> Locatário</h2>
                </div>
                <div class="inside">

                    <div class="row">

                        <div class="col-md-3">
                            <label for="valor_locador">Valor Inicial</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <!-- , 'onblur' => 'checkCnpj(this.value)' -->
                                </div>
                                {!! Form::number('valor_locador', Config::get('madecms.valor_locador'), 
                                    ['class' => 'form-control',
                                     'id'=>'valor1',
                                     'step' => 'any' 
                                ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="valor_percent">Reajuste %</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <!-- , 'onblur' => 'checkCnpj(this.value)' -->
                                </div>
                                {!! Form::number('valor_percent', Config::get('madecms.valor_percent'), 
                                    ['class' => 'form-control',
                                     'id'=>'valor2',
                                     'step' => 'any' 
                                ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="valor_locacao">Valor Atual</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <!-- , 'onblur' => 'checkCnpj(this.value)' -->
                                </div>
                                {!! Form::number('valor_locacao', Config::get('madecms.valor_locacao'), 
                                    ['class' => 'form-control',
                                     'id'=>'result',
                                     'step' => 'any', 
                                     'readonly' => 'readonly' 
                                ] ) !!}
                            </div>
                        </div>

                        

                        
                    </div>

                    <div class="row mtop16">


                            <div class="col-md-3">
                                <label for="cnpj_locador">CNPJ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <!-- , 'onblur' => 'checkCnpj(this.value)' -->
                                    </div>
                                    {!! Form::text('cnpj_locador', Config::get('madecms.cnpj_locador'), ['class' => 'form-control' ] ) !!}
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label for="name_locador">Razão Social</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">

                                    </div>
                                    {!! Form::text('name_locador', Config::get('madecms.name_locador'), ['class' => 'form-control'
                                            ] ) !!}
                                </div>
                            </div>

                    </div>



                    <div class="row mtop16">
                        <div class="col-md-2">
                            <label for="cep_locador">CEP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('cep_locador', Config::get('madecms.cep_locador'), ['class' => 'form-control', 'id' => 'cep2','onblur' => 'cep2(this.value)'] ) !!}
                            </div>
                        </div>
                        
                      

                        <div class="col-md-5">
                            <label for="logradouro_locador">Endereço</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('logradouro_locador', Config::get('madecms.logradouro_locador'), ['class' => 'form-control',
                                    'id' => 'rua_locador','readonly'=> 'readonly' ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="numero_locador">Número</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('numero_locador', Config::get('madecms.numero_locador'), ['class' => 'form-control'
                                         ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="complemento_locador">Complemto:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('complemento_locador', Config::get('madecms.complemento_locador'), ['class' => 'form-control', 'id' => 'complemento', 'style'=>'text-transform: uppercase;'] ) !!}
                            </div>
                        </div>
                    </div>


                    <div class="row mtop16">
                        <div class="col-md-4">
                            <label for="bairro_locador">Bairro:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('bairro_locador', Config::get('madecms.bairro_locador'), ['class' => 'form-control', 'id' => 'bairro_locador','readonly'=> 'readonly'
                                         ] ) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="municipio_locador">Município:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('municipio_locador', Config::get('madecms.municipio'), ['class' => 'form-control', 'id' => 'cidade_locador','readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label for="uf_locador">UF:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('uf_locador', Config::get('madecms.uf_locador'), ['class' => 'form-control', 'id' => 'uf_locador',
                                         'readonly'=> 'readonly'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="company_phone_locador">Telefone:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('company_phone_locador', Config::get('madecms.company_phone_locador'), ['class' => 'form-control'] ) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="email_locador">E-mail Contato:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                {!! Form::text('email_locador', Config::get('madecms.email_locador'), ['class' => 'form-control', 'id' => 'email'] ) !!}
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mtop16">
        <div class="row">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="inside">
                        {!! Form::submit('Gravar', ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
   
{!! Form::close() !!}


@endsection

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
                // var valor3 = (jQuery('#valor3').val() == '' ? 0 : jQuery('#valor3').val());
                // var valor4 = (jQuery('#valor4').val() == '' ? 0 : jQuery('#valor4').val());
                // var valor5 = (jQuery('#valor5').val() == '' ? 0 : jQuery('#valor5').val());
                // var valor6 = (jQuery('#valor6').val() == '' ? 0 : jQuery('#valor6').val());


                var result = (parseFloat(valor1) * parseFloat(valor2) / parseFloat(100) + parseFloat(valor1));
                jQuery('#result').val(parseFloat(result));

            });
        });
    </script>


