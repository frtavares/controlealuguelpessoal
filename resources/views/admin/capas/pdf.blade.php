

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title style="text-decoration: bold;">Capa de Lote -{{$p->id}}</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

 <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css">

 </head>

<body>

    <fieldset style="width: 670px; height: 90px;">

          <fieldset style="width: 110px; height: 65px;display: inline-block;border: none;">

            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/static/images/ziran.png'))) }}">
              <p>
                N º {{$p->id}}
              </p>

          </fieldset>

          <h6 style="text-align: center;position: absolute; display: inline-block;font-family: 'Indie Flower', sans-serif;">

                <fieldset style="width: 500px; height: 65px;position: absolute;margin-top:auto;display: inline-block;font-family: 'Indie Flower', sans-serif;">
                  <p style="font-size: 12px;text-align: center;">
                    <strong>CAPA DE LOTE</strong>
                    <br>
                      {{ Config::get('madecms.name') }} <br>
                      CNPJ {{ Config::get('madecms.cnpj') }} - R.A {{ Config::get('madecms.recinto') }}<br>
                      {{ Config::get('madecms.logradouro') }},{{ Config::get('madecms.numero') }},{{ Config::get('madecms.bairro') }}- {{ Config::get('madecms.municipio') }} - {{ Config::get('madecms.uf') }} , Cep {{ Config::get('madecms.cep') }} <br>
                      Tel {{ Config::get('madecms.company_phone') }} <br>
                  </p>
                </fieldset>

            </h6>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </fieldset>
<br>
    <h7 class="card-title pr-0" style="text-align: left;">
    <div style="font-family: 'Indie Flower', sans-serif;font-size:14px;">
    Data de Entrada: <strong> {{ date( 'd/m/Y' , strtotime($p->dataservico))}}</strong></h7>
    </div>

     <fieldset >
     <legend>Cliente/ Exportador:</legend>
     <div style="font-family: 'Indie Flower', sans-serif;font-size:14px;">
     <h7><b>{{$p->clis->namecnpj}}</b></h7>
     </div>
     </fieldset>

     <fieldset>
     <legend>Dados da Transportadora:</legend>
     <div style="font-family: 'Indie Flower', sans-serif;font-size:14px;">
     <h7 class="card-title"><strong>{{$p->trans->namecnpj}}</strong></h7><br>

     </div>


     </fieldset>


     <fieldset>
<legend>Motorista</legend>
<div style="font-family: 'Indie Flower', sans-serif;font-size:14px;">


     <h7 class="card-title"><b>{{$p->pess->namecpf}}</b></h7><br>


</div>
</fieldset>




     <fieldset>
     <legend>Placas</legend>

<div style="font-family: 'Indie Flower', sans-serif;font-size:14px;">

<h7 class="card-title">Placa Cavalo:
              <h7 style="text-transform: uppercase;"><b>{{$p->placa}}</b></h7>
             </h7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <h7 class="card-title">Placa Carreta:
              <h7 style="text-transform: uppercase;"><b>{{$p->placa2}}</b></h7>
            </h7>
</div>


     </fieldset>

     <fieldset>
     <legend>Dados da Unidade</legend>

     <div style="font-family: 'Indie Flower', sans-serif;font-size:14px;">

     <h7 class="card-title">Container:&nbsp;<strong>{{$p->code}}</strong></h7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <h7 class="card-title">Tara:&nbsp;<strong>{{$p->tara}} </strong></h7>&nbsp;&nbsp;&nbsp;
     <h7 class="card-title">Tipo/ ISO:&nbsp; <strong>{{$p->isoss->name}}</strong></h7><br>
     <h7 class="card-title">Lacre 1:
              <h7 style="text-transform: uppercase;"><b>{{$p->lacre}}</b></h7>
    </h7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <h7 class="card-title">Lacre 2:
              <h7 style="text-transform: uppercase;"><b>{{$p->lacre2}}</b></h7>
            </h7>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <h7 class="card-title">Booking:&nbsp; <strong>{{$p->booking}}</strong></h7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <br> <h7 class="card-title">Navio:&nbsp;<strong> {{$p->navio}}</strong></h7><br>
     <h7 class="card-title">Documento/ NF-e:&nbsp; <strong>{{$p->danfe}}</strong></h7><br>
     <h7 class="card-title">Carga:&nbsp;<strong>{{$p->carga}}</strong></h7><br>
</div>

     </fieldset>









     <fieldset >
     <legend>Resultado da Pesagem</legend>

              <div style="font-family: 'Indie Flower', sans-serif;font-size:14px;">
<b></b>
              <br>
                <i class="fab fa-tumblr-square"></i>  Tara:&nbsp;<b>{{$p->tara}} </b>
                &nbsp;&nbsp;&nbsp;&nbsp;

                <i class="fas fa-truck"></i> Peso Entrada:&nbsp;<b>{{$p->pesoentrada}}</b>

                &nbsp;&nbsp;&nbsp;&nbsp;

                <i class="fas fa-truck-pickup"></i> Peso Vazio:&nbsp;<b>{{$p->pesovazio}} </b>
                &nbsp;&nbsp;&nbsp;&nbsp;


                <i class="fas fa-box"></i> Peso Bruto:&nbsp; <b>{{$p->pesobruto}} </b><br>
     <br>
<div>

  <i class="fas fa-boxes"></i> Peso Líquido:&nbsp;<b>{{$p->pesocarga}}
</div>


          </b>

              </div>

              </fieldset>


<fieldset style="font-family: 'Indie Flower', sans-serif;font-size:15px;">



  <legend>Uso Interno</legend>

  <br>

  Unitizado[ &nbsp;&nbsp;]&nbsp;&nbsp;Desunitizado[ &nbsp;&nbsp; ]&nbsp;&nbsp;Movimentação[ &nbsp;&nbsp; ]&nbsp;&nbsp;&nbsp;&nbsp;Início Transito:&nbsp;&nbsp;SIM[ &nbsp;&nbsp; ] NÃO[ &nbsp;&nbsp; ]
         <br> <br>
  Pedido: _________________ NTE:_________________ Valor Total NF-e:_______________
  <br> <br>
  Exportador:________________________________________ CPF:____________________
  <br> <br>
  Terminal de Entrega: _________________ Data/Hora Entrada p/ Embarque: ___/___/_____
  <br> <br>
  ISS:_________ Conferente: ___________________ OBS.:__________________________

</fieldset>

<div>
<h6 style="font-family: 'Indie Flower', sans-serif;font-size:8px;">
Usuário:{{$p->userlog}}
</h6>


<h6 style="font-family: 'Indie Flower', sans-serif;font-size:8px;text-align: right;">  Copyright &copy; frtSYS Developer, <?php echo date("Y"); ?>
    </h6>


</div>


</body>



</html>
