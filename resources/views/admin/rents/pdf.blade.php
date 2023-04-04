

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title style="text-decoration: bold;">Fatura Aluguel -{{$r->id}}</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

 <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css">

 <style type="text/css">
    .container {
    height: 20px;
    width:600px;      
}
.left {
    float:left;
    width:300px;
}

.mid {
    float:center;
    width:300px;
    margin-left: 200px;
    margin-right: 100px;
}

.center {
    float:center;
    width:300px;
    margin-left: 200px;
    margin-right: 100px;
}

.right {
    float:right;
    width:300px;
    margin-left: 520px;
}
</style>

 </head>

<body>

          {{-- <fieldset style="width: 110px; height: 65px;display: inline-block;border: none;">

            <!-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/static/images/ziran.png'))) }}"> -->
           
              <div style="font-family: 'Indie Flower', sans-serif;font-size:10px;text-align:left;">
                 <strong> ID{{$r->code}}{{$r->id}}</strong>
                Emissão: {{ date( 'd/m/Y' , strtotime($r->created_at))}}
              </div>   
              

          </fieldset> --}}

          <div style="font-family: 'Indie Flower', sans-serif;font-size:10px;text-align:left;">
            <strong> ID{{$r->code}}{{$r->id}}</strong>
           Emissão: {{ date( 'd/m/Y' , strtotime($r->created_at))}}
         </div>   

          {{-- <h6 style="text-align: center;position: absolute; display: inline-block;font-family: 'Indie Flower', sans-serif;">

                
            </h6> --}}

            <div class="" style="align-content: center">
              <p style="font-size: 14px;text-align: center;font-family: 'Indie Flower', sans-serif;border: none;">
                <strong>FATURA LOCAÇÃO IMÓVEL</strong>
                <br>
                Dados do Imóvel:  <br>
                  {{ Config::get('madecms.logradouro') }},{{ Config::get('madecms.numero') }},{{ Config::get('madecms.complemento') }} <br>
                  {{ Config::get('madecms.bairro') }}- {{ Config::get('madecms.municipio') }} - {{ Config::get('madecms.uf') }} , Cep {{ Config::get('madecms.cep') }} <br>
                  Contato: {{ Config::get('madecms.company_phone') }} , {{ Config::get('madecms.email') }}  <br>
              </p>
            </div>


            {{-- <fieldset style="width: 500px; height: 65px;position: absolute;margin-top:auto;display: inline-block;font-family: 'Indie Flower', sans-serif;border: none;">
              
              
            </fieldset> --}}

            


<br>
   

<div class="container">
  <div class="left">
    <fieldset style="height:20px;width: 150px;">
      <legend>Vencimento</legend>
     <div style="font-family: 'Indie Flower', sans-serif;font-size:18px;text-align:center;">
       <b>{{ date( 'd/m/Y' , strtotime($r->vencimento))}}</b>
     </div>   
    </fieldset>
  </div>

  <div class="center">
  <fieldset style="height:20px;width: 150px;">
      <legend>Total a pagar</legend>
      <div style="font-family: 'Indie Flower', sans-serif;font-size:18px;text-align:center;">
       <b> R$ {{ number_format($r->total, 2, ',', '') }}</b>
     </div>
    </fieldset>
  </div> 

</div>

<br><br>

    <fieldset style="height:20px;width: 670px;">
      <legend>Locatário:</legend>
     <div style="font-family: 'Indie Flower', sans-serif;font-size:12px;text-align:left;">
      {{ Config::get('madecms.name_locador') }}
     </div>   
    </fieldset>

Dados para depósito
<div class="container">
  <div class="left">
    <fieldset style="height:20px;width: 250px;">
      <legend>Banco</legend>
     <div style="font-family: 'Indie Flower', sans-serif;font-size:12px;text-align:left;">
       {{ Config::get('madecms.banco') }}
     </div>   
    </fieldset>
  </div>

  <div class="mid">
  <fieldset style="height:20px;width: 105px;margin-left: 90px;">
      <legend>CNPJ/ CPF</legend>
      <div style="font-family: 'Indie Flower', sans-serif;font-size:12px;text-align:center;">
      {{ Config::get('madecms.cnpj') }}
     </div>
    </fieldset>
  </div> 

  <div class="center">
  <fieldset style="height:20px;width: 105px;margin-left: 230px;">
      <legend>Agência</legend>
      <div style="font-family: 'Indie Flower', sans-serif;font-size:12px;text-align:center;">
      {{ Config::get('madecms.agencia') }}
     </div>
    </fieldset>
  </div> 

  <div class="right">
  <fieldset style="height:20px;width: 100px;margin-left: 270px;">
      <legend>Conta</legend>
      <div style="font-family: 'Indie Flower', sans-serif;font-size:12px;text-align:center;">
       {{ Config::get('madecms.conta') }}
     </div>
    </fieldset>
  </div> 

 
</div>
   
   
<br>
<br>





Faturamento
<fieldset>
    <legend>Descrição / Valores</legend>
    <br>
     <div class="row">

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:12px;">
     <h7>ALUGUEL REF. {{$r->mesess->mes}}/{{$r->ano_id}}</h7>
     <div style="text-align:right;border:none;">{{ number_format($r->valor, 2, ',', '') }}</div>
     </div>

     <hr style="height:1px;border:none;color:#333;background-color:#333;">

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:12px;">
     <h7>CONDOMÍNIO COTA {{ date( 'm/Y' , strtotime($r->vencimento))}}</h7>
     <div style="text-align:right;border:none;">{{ number_format($r->condominio, 2, ',', '') }}</div>
     </div>

     <hr style="height:1px;border:none;color:#333;background-color:#333;">

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:12px;">
     <h7>Taxa Extra</h7>
     <div style="text-align:right;border:none;">{{ number_format($r->taxaextra, 2, ',', '') }}</div>
     </div>
     
     <hr style="height:1px;border:none;color:#333;background-color:#333;">

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:12px;">
     <h7>IPTU</h7>
     <div style="text-align:right;border:none;">{{ number_format($r->iptu, 2, ',', '') }}</div>
     </div>

     <hr style="height:1px;border:none;color:#333;background-color:#333;">
     

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:12px;">
     <h7>Taxa de Incêndio</h7>
     <div style="text-align:right;border:none;">{{ number_format($r->taxaincendio, 2, ',', '') }}</div>
     </div>

     <hr style="height:1px;border:none;color:#333;background-color:#333;">

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:12px;">
     <h7>Seguro Residencial</h7>
     
     <div style="text-align:right;border:none;">{{ number_format($r->seguro, 2, ',', '') }}</div>
     </div>

     <hr style="height:1px;border:none;color:#333;background-color:#333;">
     

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:12px;">
     <h7>Desconto</h7>
     <div style="text-align:right;border:none;">{{ number_format($r->desconto, 2, ',', '') }}</div>
     </div>

    
     
     </div>


     </fieldset>

     

     





     <fieldset style="text-align:right;">
     
     <legend>Subtotal</legend>
     <div class="row">

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:14px;">
     <h7>R$ {{ number_format($r->subtotal, 2, ',', '') }}</h7>
     </div>

     
     </div>

     </fieldset>


     <fieldset style="text-align:right;">
     
     <legend>Valor Total a pagar</legend>
     <div class="row">

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:14px;">
     <h7 style="text-align:right;">R$ {{ number_format($r->total, 2, ',', '') }}</h7>
     </div>

     
     </div>

     </fieldset>


     <fieldset style="text-align:right;">
     
     <legend>Mensagem</legend>
     <div class="row">

     <div class="col-md-2" style="font-family: 'Indie Flower', sans-serif;font-size:14px;text-align:left;">
     <h7>{{$r->observacoes}}</h7>
     </div>

     
     </div>

     </fieldset>





     <h6 style="font-family: 'Indie Flower', sans-serif;font-size:8px;text-align: right;">  Copyright &copy; frtSYS Developer, <?php echo date("Y"); ?>
    </h6>

{{-- 
  <div style="font-family: 'Indie Flower', sans-serif;font-size:10px;text-align:left;">
       Emissão: {{ date( 'd/m/Y' , strtotime($r->created_at))}}
     </div>    --}}

</body>



</html>
