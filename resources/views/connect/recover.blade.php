@extends('connect.master')

@section('title', 'Recuperar senha')

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
                  <h3> <strong>Recuperar senha</strong></h3>
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
				{!! Form::open(['url' => '/recover']) !!}

                  <div class="form-group first">
                    <label for="name">E-mail</label>
					{!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                  </div>

				
				 {!! Form::submit('Recuperar senha', ['class' => 'btn btn-pill text-white btn-block btn-warning']) !!}

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










