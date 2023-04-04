@extends('admin.master')

@section('title', 'ISO')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/isos/1') }}"><i class="fa fa-flag"></i> ISO</a>
</li>

@endsection

@section('css')
<link rel="stylesheet" href="{{ url('/static/css/rowGroup.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">

            <ul style="float:left;margin-left:20px;">
                @if(kvfj(Auth::user()->permissions, 'iso_add'))
                <li >
                    <a href="{{ url('/admin/iso/add') }}">
                        <i class="fas fa-plus"></i> Novo
                    </a>
                </li>
                @endif

                <li>
                    <a href="#" id="btn_search">
                        <i class="fas fa-search"></i> Buscar
                    </a>
                </li>



            </ul>
            <ul>
            <li>
                    <a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
                    <ul class="shadow">
                        <li><a href="{{ url('/admin/isos/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
                        <li><a href="{{ url('/admin/isos/0') }}"><i class="fas fa-eraser" ></i> Inativo</a></li>
                        <li><a href="{{ url('/admin/isos/trash') }}"><i class="fas fa-trash"></i> Lixeira</a></li>
                        <li><a href="{{ url('/admin/isos/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="inside">

            <div class="form_search" id="form_search">
                {!! Form::open(['url' => '/admin/iso/search']) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquise aqui', 'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::select('filter', ['0' => 'Nome', '1' => 'ID'], 0, ['class' => 'form-select']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('status', ['1' => 'Públicos', '0' => 'Inativo'], 0, ['class' => 'form-select']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Descrição</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($isos as $p)
                    <tr>
                        <td width="50">{{ $p->id }}</td>
                        <td>{{ $p->name }}</td>


                        <td width="160">
                            <div class="opts">

                                @if(kvfj(Auth::user()->permissions, 'iso_edit'))
                                <a href="{{ url('/admin/iso/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit">
                                    <i class="fas fa-pencil-alt fa-2x"></i>
                                </a>
                                @endif



                                @if(kvfj(Auth::user()->permissions, 'iso_delete'))
                                    @if(is_null($p->deleted_at))
                                    <a href="#" data-path="admin/iso" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted delete">
                                        <i class="fas fa-trash-alt fa-2x"></i>
                                    </a>
                                    @else
                                    <a href="{{ url('/admin/iso/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/iso" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore">
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
                                <td colspan="6">{!! $isos->render() !!}</td>

                            </tr>
                        </div>
                </tbody>

            </table>
                <tr>
                     <td colspan="6">{!! $isos->count() !!} </td>resultados do total de
                     <td colspan="6">{!! $isos->total() !!} </td>registros
                </tr>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('/static/js/responsive.bootstrap4.min.js') }}"></script>
@endsection
