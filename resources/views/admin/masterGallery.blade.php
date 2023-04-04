@yield('css')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="{{ url('/static/css/gallery.css?v='.time()) }}">
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

 


    <!-- Page Content -->
   <div class="container page-top">



   <div class="row">

            

        @section('content')
				@show
            
                </div>
           
       </div>

     
      

    </div>
    @yield('js')
    <script src="{{ url('/static/js/gallery.js?v='.time()) }}"></script>
    