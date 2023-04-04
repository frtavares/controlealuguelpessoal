@extends('admin.master')

@section('title', 'Transportadora')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/transportadoras/1') }}"><i class="fas fa-truck"></i>
	 Transportadora</a>
</li>
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/static/css/rowGroup.bootstrap4.min.css') }}">
<style>
.table{
   display: block !important;
   overflow-x: auto !important;
   width: 100% !important;

}

.inside .btn-pill {
    border-radius: 30px;
}
</style>
@endsection


@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="row">
            <div class="header">
                <ul style="float:left;margin-left:20px;">
                    @if(kvfj(Auth::user()->permissions, 'transportadora_add'))
                        <li >
                            <a href="{{ url('/admin/transportadora/add') }}">
                                <i class="fas fa-plus"></i> Novo
                            </a>
                        </li>
                    @endif
                </ul>
                <ul>
                <li>
                    <a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
                    <ul class="shadow">
                        <li><a href="{{ url('/admin/transportadoras/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
                        <li><a href="{{ url('/admin/transportadoras/0') }}"><i class="fas fa-eraser" ></i> Inativo</a></li>
                        <li><a href="{{ url('/admin/transportadoras/trash') }}"><i class="fas fa-trash"></i> Lixeira</a></li>
                        <li><a href="{{ url('/admin/transportadoras/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
                    </ul>
                </li>
                </ul>
            </div>

        </div>

        <div class="header">

            <ul style="float:left;margin-left:20px;">
                @if(kvfj(Auth::user()->permissions, 'transportadora_add'))
                    <li>
                        <a href="#" id="btn_search">
                            <i class="fas fa-search"></i> Buscar
                        </a>
                    </li>
                @endif
            </ul>

        </div>

        <div class="inside">

            <div class="form_search" id="form_search">
                {!! Form::open(['url' => '/admin/transportadora/search']) !!}
                <div class="row">
                    <div class="col-md-4 mtop16">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquise aqui', 'required']) !!}
                    </div>
                    <div class="col-md-4 mtop16">
                        {!! Form::select('filter', ['0' => 'CNPJ', '1' => 'Nome Fantasia'], 0, ['class' => 'form-select']) !!}
                    </div>
                    <div class="col-md-2 mtop16">
                        {!! Form::select('status', ['1' => 'Públicos', '0' => 'Inativo'], 0, ['class' => 'form-select']) !!}
                    </div>
                    <div class="col-md-1 mtop16">
                        {!! Form::submit('Buscar', ['class' => 'btn btn-pill text-white btn-block btn-dark']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <td>Nome Fantasia</td>
                        <td>CNPJ</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transportadoras as $p)
                        <tr>

                            <td>{{ $p->fantasia }}</td>
                            <td>{{ $p->cnpj }}</td>

                            <td width="160">
                                <div class="opts">
                                    @if(kvfj(Auth::user()->permissions, 'transportadora_edit'))
                                        <a href="{{ url('/admin/transportadora/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit mtop16">
                                            <i class="fas fa-pencil-alt fa-2x"></i>
                                        </a>
                                    @endif
                                    @if(kvfj(Auth::user()->permissions, 'transportadora_delete'))
                                        @if(is_null($p->deleted_at))
                                        <a href="#" data-path="admin/transportadora" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted delete mtop16">
                                            <i class="fas fa-trash-alt fa-2x"></i>
                                        </a>
                                        @else
                                        <a href="{{ url('/admin/transportadora/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/transportadora" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore mtop16">
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
                            <td colspan="6">{!! $transportadoras->render() !!}</td>
                        </tr>
                    </div>
                </tbody>

            </table>
            <tr>
                <td colspan="6">{!! $transportadoras->count() !!} </td>resultados do total de
                <td colspan="6">{!! $transportadoras->total() !!} </td>registros
            </tr>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('/static/js/responsive.bootstrap4.min.js') }}"></script>

@endsection

