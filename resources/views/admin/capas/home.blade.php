@extends('admin.master')

@section('title', 'Capa de Lote')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/capas/1') }}"><i class="fas fa-list"></i> Capa de Lote</a>
</li>

@endsection

@section('css')
<link rel="stylesheet" href="{{ url('/static/css/rowGroup.bootstrap4.min.css') }}">

<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
.size_of_img{
width:90px}
</style>
@endsection


@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">

            <ul style="float:left;margin-left:20px;">
                @if(kvfj(Auth::user()->permissions, 'capa_add'))
                <li >
                    <a href="{{ url('/admin/capa/add') }}">
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
                        <li><a href="{{ url('/admin/capas/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
                        <li><a href="{{ url('/admin/capas/0') }}"><i class="fas fa-eraser" ></i> Inativo</a></li>
                        <li><a href="{{ url('/admin/capas/trash') }}"><i class="fas fa-trash"></i> Lixeira</a></li>
                        <li><a href="{{ url('/admin/capas/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="inside">

            <div class="form_search" id="form_search">
                {!! Form::open(['url' => '/admin/capa/search']) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquise aqui', 'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::select('filter', ['0' => 'Container', '1' => 'Booking'], 0, ['class' => 'form-select']) !!}
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

            <table  class="table table-striped">
                <thead>
                    <tr>
                        <td>Entrada</td>
                        <td>Container</td>
                        <td>Booking/Reserva</td>
                        <td>Nome Fantasia</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($capas as $p)
                    <tr>
                       <td>{{ date( 'd/m/Y' , strtotime($p->dataservico))}}</td>
                       <td>{{ $p->code }}</td>
                       <td>{{ $p->booking }}</td>
                       <td>{{ $p->clis->fantasia }}</td>

                        <td width="160">
                            <div class="opts">

                                @if(kvfj(Auth::user()->permissions, 'capa_edit'))
                                <a href="{{ url('/admin/capa/'.$p->id.'/edit') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" class=" mtop16">
                                <img src="{{ url('/static/images/icones/editar.png') }}" style="width: 40px; height:40px;">
                               
                                </a>
                               
                                @endif

                                @if(kvfj(Auth::user()->permissions, 'capa_pdf'))
                                

                                <a  href="{{ url('/admin/capas/'.$p->id.'/pdf') }}" data-mdb-toggle="tooltip" title="Imprimir documento" class="mtop16" >
                                    <img src="{{ url('/static/images/icones/pdf.png') }}" style="width: 40px; height:40px;">
                                    </a>
                               
                                    

                                @endif

                                @if(kvfj(Auth::user()->permissions, 'capa_delete'))
                                    @if(is_null($p->deleted_at))
                                    <a href="#" data-path="admin/capa" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted  mtop16">
                                     <img src="{{ url('/static/images/icones/lixeira.png') }}" style="width: 40px; height:40px;">
                                    </a>
                                    @else
                                    <a href="{{ url('/admin/capa/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/capa" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore mtop16">
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
                                <td colspan="6">{!! $capas->render() !!}</td>

                            </tr>
                        </div>
                </tbody>

            </table>
                <tr>
                     <td colspan="6">{!! $capas->count() !!} </td>resultados do total de
                     <td colspan="6">{!! $capas->total() !!} </td>registros
                </tr>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ url('/static/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
@endsection
