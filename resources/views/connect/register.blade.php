@extends('connect.master')

@section('title', 'Nova conta')

@section('content')


<div class="content">
    <div class="container">
      <div class="row justify-content-center">
        <!-- <div class="col-md-6 order-md-2">
          <img src="images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div> -->
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="form-block">
			  
                  <div class="mb-4">
                  <h3> <strong>Nova conta</strong></h3>
                  <p class="mb-4"></p>
				  @if(Session::has('message'))
			<div class="container mtop16">              
				<div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:none;"> 
					{{ Session::get('message') }}
					@if ($errors->any())       
					<ul>
						@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
					@endif
					<script>
						$('.alert').slideDown();
						setTimeout(function(){ $('.alert').slideUp(); }, 10000);
					</script>
				</div>
			</div>
		@endif
                </div>
                <form action="#" method="post">
				{!! Form::open(['url' => '/register']) !!}

                  <div class="form-group first">
                    <label for="name">Primeiro Nome</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'required','style'=>'text-transform: uppercase;']) !!}
                  </div>

				  <div class="form-group last mb-4">
                    <label for="lastname">Sobrenome</label>
                    {!! Form::text('lastname', null, ['class' => 'form-control', 'required','style'=>'text-transform: uppercase;']) !!}
                  </div>

                  <div class="form-group last mb-4">
                    <label for="email">E-mail</label>
                    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                  </div>

				  <div class="form-group last mb-4">
                    <label for="password">Senha</label>
                    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                  </div>

				  <div class="form-group last mb-4">
                    <label for="cpassword">Confirmar senha</label>
					{!! Form::password('cpassword', ['class' => 'form-control', 'required']) !!}
                  </div>
                  
                 

				 {!! Form::submit('Registrar', ['class' => 'btn btn-pill text-white btn-block btn-danger']) !!}

					{!! Form::close() !!}


					<br>
					<span class="ml-auto"><a href="{{ url('/login') }}" class="forgot-pass">Cancelar</a></span> 
                  </div>

	
                   
                </form>

				

              </div>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>



@stop