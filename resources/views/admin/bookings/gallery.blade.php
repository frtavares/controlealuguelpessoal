@extends('admin.masterGallery')


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
@section("css")

<link rel="stylesheet" href="{{ url('/static/css/gallery.css?v='.time()) }}">
@endsection

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Relatório fotográfico</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/lightgallery/1.3.9/css/lightgallery.min.css" rel="stylesheet">
        <style>body{background-color:#152836}h2{color:#fff;margin-bottom:40px;text-align:center;font-weight:100;}</style>
    </head>
    <body class="home">
        <div class="container" style="margin-top:40px;">
            <h2>Relatório fotográfico</h2>
            <ol class="breadcrumb-item">
        <a href="{{ url('/admin/bookings/1') }}"><< Voltar</a>
</ol>
            <div class="demo-gallery">
                <ul id="lightgallery" class="list-unstyled row">

    
                @foreach($p->getGallery as $img)
                <li class="col-xs-6 col-sm-4 col-md-2 col-lg-2" data-src="{{ url('./uploads/'.$img->file_path.'/t_'.$img->file_name)}}" data-responsive="{{ url('./uploads/'.$img->file_path.'/t_'.$img->file_name)}}" data-sub-html="">
        <a href="">
            <img class="img-responsive" src="{{ url('./uploads/'.$img->file_path.'/t_'.$img->file_name)}}" style="width: 210px; height: 210px;">
        </a>
    </li>
           @endforeach        
                </ul>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#lightgallery').lightGallery(); 
            });
        </script>
    </body>    
</html>

@section('js')

<script src="{{ url('/static/js/gallery.js?v='.time()) }}"></script>

@endsection