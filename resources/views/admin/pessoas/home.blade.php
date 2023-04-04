@extends('admin.master')
@section('title', 'Faturamento Locação')

@section('content')

@section('breadcrumb')
    <ol class="breadcrumb-item">
        <a href="{{ url('/admin/tickets/1') }}"><i class="fa fa-tag"></i> Faturamento Locação</a>
    </ol>
@endsection

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container-fluid">
                <nav class="navbar navbar-expand navbar-light mb-12">

                    @if (kvfj(Auth::user()->permissions, 'pessoa_add'))
                        <a class="btn btn-primary btn-circle" href="{{ url('/admin/pessoa/add') }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Incluir Novo Registro">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    @endif

                    <div class="card-body mb-12">
                        <div class="form_search" id="form_search">
                            {!! Form::open(['url' => '/admin/pessoa/search']) !!}

                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary"><i
                                            class="fa-solid fa-magnifying-glass" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Clique aqui para pesquisar"></i></h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse" id="collapseCardExample">
                                    <div class="card-body ">

                                        <div class="row">

                                            <div class="col-md-5">
                                                {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquise aqui', 'required', 'id' => 'exampleFormControlInput1']) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::select('filter', ['0' => 'Pesquisar por Nome', '1' => 'Pesquisar por CPF'], 0, ['class' => 'form-control']) !!}
                                            </div>

                                            <div class="col-md-3">
                                                Inativo
                                                {{ Form::radio('status', '0', true) }}
                                                Ativo
                                                {{ Form::radio('status', '1', true) }}
                                            </div>

                                            <div class="col-md-1">
                                                {!! Form::submit('Buscar', ['class' => 'btn btn-success']) !!}
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filtrar
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/admin/pessoas/1') }}">Públicos</a>
                                <a class="dropdown-item" href="{{ url('/admin/pessoas/0') }}">Inativos</a>
                                <a class="dropdown-item" href="{{ url('/admin/pessoas/all') }}">Todos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/admin/pessoas/trash') }}">Removidos</a>
                            </div>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>Nome</td>
                            <td>CPF</td>
                            <td>Função</td>
                            <td>Ações</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pessoas as $p)
                            <tr>

                                <td>{{ $p->name }}</td>
                                <td>{{ $p->cpf }}</td>
                                <td>{{ $p->occs->name }}</td>

                                <td width="160">
                                    <div class="opts">

                                        @if (kvfj(Auth::user()->permissions, 'pessoa_edit'))
                                            <a href="{{ url('/admin/pessoa/' . $p->id . '/edit') }}"
                                                data-toggle="tooltip" data-placement="top" title="Editar"
                                                class="edit">
                                                <i class="fas fa-pencil-alt fa-2x"></i>
                                            </a>
                                        @endif



                                        @if (kvfj(Auth::user()->permissions, 'pessoa_delete'))
                                            @if (is_null($p->deleted_at))
                                                <a href="#" data-path="admin/pessoa" data-action="delete"
                                                    data-object="{{ $p->id }}" data-toggle="tooltip"
                                                    data-placement="top" title="Excluir" class="btn-deleted delete">
                                                    <i class="fas fa-trash-alt fa-2x"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('/admin/pessoa/' . $p->id . '/restore') }}"
                                                    data-action="restore" data-path="admin/pessoa"
                                                    data-object="{{ $p->id }}" data-toggle="tooltip"
                                                    data-placement="top" title="Restaurar" class="btn-deleted restore">
                                                    <i class="fas fa-trash-restore fa-2x"></i>
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <div class="mtop16">
                            <tr>
                                <td colspan="6">{!! $pessoas->render() !!}</td>
                            </tr>
                        </div>
                    </tbody>

                </table>
                <tr>
                    <td colspan="6">{!! $pessoas->count() !!} </td>resultados do total de
                    <td colspan="6">{!! $pessoas->total() !!} </td>registros
                </tr>
            </div>
        </div>
    </div>
</div>


@endsection
