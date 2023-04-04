
<!DOCTYPE html>
<html lang="pt=br">
    <head>
    <title>@yield('title')- Capa de Lote</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csfr-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <link rel="stylesheet" href="{{ url('/static/css/styles.css?v='.time()) }}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

    <script src="https://kit.fontawesome.com/bc09de731a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ url('/static/js/sweetalert.min.js?v='.time()) }}"></script>


    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
    </head>
    <body>

<div class="container-fluid">




</div>

        <script src="{{ url('/static/js/dist/jquery-3.5.1.min.js?v='.time()) }}"></script>
        <script src="{{ url('/static/js/admin.js?v='.time()) }}"></script>
        <script src="{{ url('/static/js/dist/bootstrap.bundle.min.js?v='.time()) }}"></script>
        <script src="{{ url('/static/js/dist/scripts.js?v='.time()) }}"></script>
        <script src="{{ url('/static/js/dist/Chart.min.js?v='.time()) }}"></script>
        <script src="{{ url('/static/js/dist/jquery.dataTables.min.js?v='.time()) }}"></script>
        <script src="{{ url('/static/js/dist/dataTables.bootstrap4.min.js?v='.time()) }}"></script>
    </body>
</html>

