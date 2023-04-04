
@extends('admin.masterPrint')

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title style="text-decoration: bold;">Capa de Lote -{{$p->id}}</title> 
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

 <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css">
 
 </head>



<body style="height:100%; width:100%;">




          <h6>Container: {{$p->codigo}}</h6>
          <h6 class="card-title">Exportador: {{$p->clis->name}}</h6>
          <h6 class="card-title">Navio: {{$p->ships->name}}</h6>
          <h6 class="card-title">Data: {{ date( 'd/m/Y H:i:s' , strtotime($p->entrada))}}</h6>
   
    



<div class="row">
  <div class="col-xs-8 col-md-6 pl-0 mt-10" style="margin-top: 5px;">
    <a href="#" class="thumbnail">
    @foreach($p->getGallery as $img)
        <img src="{{ url('./uploads/'.$img->file_path.'/t_'.$img->file_name)}}" alt="" style="width: 210px; height: 210px;margin-top: 20px;margin-bottom: 10px;margin-right: 10px;margin-left: 10px;">
       @endforeach
    </a>
  </div>

</div>












</body> 
</html>