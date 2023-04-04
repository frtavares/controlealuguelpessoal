@extends('admin.master')

@section('title', 'Usuários')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/users/1') }}"><i class="fas fa-user-friends"></i> Usuários</a>
</li>
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/static/css/rowGroup.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<div class="row ">
				<div class="col-md-2 offset-md-10">
					<div class="dropdown mtop16">
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;">
							<i class="fas fa-filter"></i> Filtrar
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="{{ url('/admin/users/all') }}"><i class="fas fa-stream"></i> Todos</a>
							<a class="dropdown-item" href="{{ url('/admin/users/0') }}"><i class="fas fa-unlink"></i> Pendentes ativação</a>
							<a class="dropdown-item" href="{{ url('/admin/users/1') }}"><i class="fas fa-user-check"></i> Ativados</a>
							<a class="dropdown-item" href="{{ url('/admin/users/100') }}"><i class="fas fa-heart-broken"></i> Suspensos</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="mtop16"></div>

		<div class="inside mtop16">
			

			 <table  class="table mtop16">
				<thead>
					<tr>
						<td>ID</td>
						<td></td>
						<td>Nome</td>
						<td>Sobrenome</td>
						<td>E-mail</td>
						<td>Perfil</td>
						<td>Situação</td>
						<td>Ações</td>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td width="48" height="48">
							@if(is_null($user->avatar))
							<img src="{{ url('/static/images/default-avatar.png') }}" class="img-fluid " style="border-radius: 50%;border: 3px solid #BADA55; width: 15em;">
							@else
							<img src="{{ url('/uploads_users/'.$user->id.'/'.$user->avatar) }}" class="img-fluid rounded-circle">
							@endif
						</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->lastname }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ getRoleUserArray(null,$user->role) }}</td>
						<td>{{ getUserStatusArray(null,$user->status) }}</td>
						<td>
							<div class="opts">
							@if(kvfj(Auth::user()->permissions, 'user_edit'))
							<a href="{{ url('/admin/user/'.$user->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit">
								<i class="fas fa-edit"></i>
							</a>
							@endif

							@if(kvfj(Auth::user()->permissions, 'user_permissions'))
							<a href="{{ url('/admin/user/'.$user->id.'/permissions') }}" data-toggle="tooltip" data-placement="top" title="Permisos de usuario" class="inventory">
								<i class="fas fa-cogs"></i>
							</a>
							@endif
							</div>
						</td>
					</tr>
					@endforeach
						
                            <tr>
                                <td colspan="6">{!! $users->render() !!}</td>
                               
                            </tr>
                       
                </tbody>

            </table>
                <tr>
                     <td colspan="6">{!! $users->count() !!} </td>resultados do total de
                     <td colspan="6">{!! $users->total() !!} </td>registros
                </tr>
		</div>
	</div>
</div>
@endsection


@section('js')
<script src="{{ url('/static/js/responsive.bootstrap4.min.js') }}"></script>
@endsection