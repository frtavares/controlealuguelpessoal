@extends('connect.master')

@section('title', 'Login')

@section('content')

<style>

.mtop16{

       margin-top: 32px;

    }
</style>

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
                  <h3> <strong>Login - frtSYS Gestão Serviços</strong></h3>
                  <p class="mb-4"></p>
                </div>
                <form action="#" method="post">
				{!! Form::open(['url' => '/login']) !!}
                  <div class="form-group first">
                    <label for="username">E-mail</label>
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group last mb-4">
                    <label for="password">Senha</label>
                    {!! Form::password('password', ['class' => 'form-control']) !!}

                  </div>

                  <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
  <label class="form-check-label" for="flexCheckChecked">
    Lembre-me
  </label>
</div>

					          <span class="ml-auto"><a href="{{ url('/register') }}" class="forgot-pass">Nova conta</a></span>

                    <span class="ml-auto"><a href="{{ url('/recover') }}" class="forgot-pass">Esqueci a senha</a></span>
                    <br>
 {!! Form::submit('Entrar', ['class' => 'btn btn-pill text-white btn-block btn-primary mtop16']) !!}
                  </div>


                  <!-- <span class="d-block text-center my-4 text-muted"> or sign in with</span> -->

                  <!-- <div class="social-login text-center">
                    <a href="#" class="facebook">
                      <span class="icon-facebook mr-3"></span>
                    </a>
                    <a href="#" class="twitter">
                      <span class="icon-twitter mr-3"></span>
                    </a>
                    <a href="#" class="google">
                      <span class="icon-google mr-3"></span>
                    </a>
                  </div> -->

		{!! Form::close() !!}
<br>
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
                </form>

              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>


@stop
