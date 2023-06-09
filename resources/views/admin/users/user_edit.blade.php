@extends('admin.master')

@section('title', 'Editar Usuario')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/users/1') }}"><i class="fas fa-user-friends"></i> Usuarios</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="page_user">
		<div class="row">

			<div class="col-md-4">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fas fa-user"></i> Dados Cadastrais</h2>
					</div>

					<div class="inside">
						<div class="mini_profile">
							@if(is_null($u->avatar))
							<img src="{{ url('/static/images/default-avatar.png') }}" class="avatar">
							@else
							<img src="{{ url('/uploads_users/'.$u->id.'/'.$u->avatar) }}" class="avatar">
							@endif
							<div class="info">
								<span class="title"><i class="far fa-address-card"></i> Nome:</span>
								<span class="text">{{ $u->name }} {{ $u->lastname }}</span>
								<span class="title"><i class="fas fa-user-tie"></i> Situação:</span>
								<span class="text">{{ getUserStatusArray(null,$u->status) }}</span>
								<span class="title"><i class="far fa-envelope"></i> E-mail:</span>
								<span class="text">{{ $u->email }}</span>
								<span class="title"><i class="far fa-calendar-alt"></i> Registro:</span>
								<span class="text">{{ $u->created_at }}</span>
								<span class="title"><i class="fas fa-user-shield"></i> Perfil de usuário:</span>
								<span class="text">{{ getRoleUserArray(null,$u->role) }}</span>
							</div>
							@if(kvfj(Auth::user()->permissions, 'user_banned'))
								@if($u->status == "100")
								<a href="{{ url('/admin/user/'.$u->id.'/banned') }}" class="btn btn-success">Ativar usuario</a>
								@else
								<a href="{{ url('/admin/user/'.$u->id.'/banned') }}" class="btn btn-danger">Suspender Usuário</a>
								@endif
							@endif
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fas fa-user-edit"></i> Editar Dados</h2>
					</div>

					<div class="inside">
						@if(kvfj(Auth::user()->permissions, 'user_edit'))
						{!! Form::open(['url' => '/admin/user/'.$u->id.'/edit']) !!}
							<div class="row">

								<div class="col-md-6">
									<label for="module">Perfil de usuário:</label>
									<div class="input-group">
										<span class="input-group-text" id="basic-addon1">
											<i class="far fa-keyboard"></i>
										</span>
										{!! Form::select('user_type', getRoleUserArray('list', null), $u->role, ['class' => 'form-select']) !!}
									</div>
								</div>

							</div>

							<div class="row mtop16">
								<div class="col-md-12">
									{!! Form::submit('Gravar', ['class' => 'btn btn-success']) !!}
								</div>
							</div>
						{!! Form::close() !!}
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection