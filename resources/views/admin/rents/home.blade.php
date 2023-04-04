@extends('admin.master')
@section('title', 'Faturamento Locação')

@section('content')

@section('breadcrumb')
    <ol class="breadcrumb-item">
        <a href="{{ url('/admin/rents/1') }}"><i class="fa fa-tag"></i> Faturamento Locação</a>
    </ol>
@endsection

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container-fluid">
                <nav class="navbar navbar-expand navbar-light mb-12">

                    @if (kvfj(Auth::user()->permissions, 'rent_add'))
                        <a class="btn btn-primary btn-circle" href="{{ url('/admin/rent/add') }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Incluir Novo Registro">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    @endif

                    <div class="card-body mb-12">
                        <div class="form_search" id="form_search">
                            {!! Form::open(['url' => '/admin/rent/search']) !!}

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
                                <a class="dropdown-item" href="{{ url('/admin/rents/1') }}">Públicos</a>
                                <a class="dropdown-item" href="{{ url('/admin/rents/0') }}">Inativos</a>
                                <a class="dropdown-item" href="{{ url('/admin/rents/all') }}">Todos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/admin/rents/trash') }}">Removidos</a>
                            </div>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>Vencimento</td>
                            <td>Valor Total</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
               
                    <tbody>
                        @foreach($rents as $r)
                        <tr>
                           <td>{{ date( 'd/m/Y' , strtotime($r->vencimento))}}</td>
                           <td>{{ $r->subtotal }}</td>
                           
                          
    
                            <td width="160">
                                <div class="opts">
    
                                    @if(kvfj(Auth::user()->permissions, 'rent_edit'))
                                    <a href="{{ url('/admin/rent/'.$r->id.'/edit') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" class=" mtop16">
                                    <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                   
                                    </a>
                                   
                                    @endif
    
                                    @if(kvfj(Auth::user()->permissions, 'rent_pdf'))
                                    
    
                                    <a  href="{{ url('/admin/rents/'.$r->id.'/pdf') }}" data-mdb-toggle="tooltip" title="Imprimir documento" class="mtop16" >
                                    <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                   
                                        
    
                                    @endif
    
                                    @if(kvfj(Auth::user()->permissions, 'rent_delete'))
                                        @if(is_null($r->deleted_at))
                                        <a href="#" data-path="admin/rent" data-action="delete" data-object="{{ $r->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted  mtop16">
                                        <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                        @else
                                        <a href="{{ url('/admin/rent/'.$r->id.'/restore') }}" data-action="restore" data-path="admin/rent" data-object="{{ $r->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore mtop16">
                                        <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    @endif   
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                        <div class="mtop16">
                            <tr>
                                <td colspan="6">{!! $rents->render() !!}</td>
                            </tr>
                        </div>
                    </tbody>
                </table>
                <tr>
                    <td colspan="6">{!! $rents->count() !!} </td>resultados do total de
                    <td colspan="6">{!! $rents->total() !!} </td>registros
                </tr>
            </div>
        </div>
    </div>
</div>


@endsection























{{-- 


@extends('admin.master')
@section('title', 'Faturamento Locação')

@section('content')

 @section('breadcrumb')
            <ol class="breadcrumb-item">
                <a href="{{ url('/admin/tickets/1') }}"><i class="fa fa-tag"></i> Faturamento Locação</a>
            </ol>
@endsection

     
 <!-- Begin Page Content -->
 <div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>Vencimento</td>
                           
                            <td>Ações</td>
                        </tr>
                    </thead>
               
                    <tbody>
                        @foreach($rents as $r)
                        <tr>
                           <td>{{ date( 'd/m/Y' , strtotime($r->vencimento))}}</td>
                           
                          
    
                            <td width="160">
                                <div class="opts">
    
                                    @if(kvfj(Auth::user()->permissions, 'rent_edit'))
                                    <a href="{{ url('/admin/rent/'.$r->id.'/edit') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" class=" mtop16">
                                    <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                   
                                    </a>
                                   
                                    @endif
    
                                    @if(kvfj(Auth::user()->permissions, 'rent_pdf'))
                                    
    
                                    <a  href="{{ url('/admin/rents/'.$r->id.'/pdf') }}" data-mdb-toggle="tooltip" title="Imprimir documento" class="mtop16" >
                                    <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                   
                                        
    
                                    @endif
    
                                    @if(kvfj(Auth::user()->permissions, 'rent_delete'))
                                        @if(is_null($r->deleted_at))
                                        <a href="#" data-path="admin/rent" data-action="delete" data-object="{{ $r->id }}" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn-deleted  mtop16">
                                        <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                        @else
                                        <a href="{{ url('/admin/rent/'.$r->id.'/restore') }}" data-action="restore" data-path="admin/rent" data-object="{{ $r->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted restore mtop16">
                                        <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    @endif   
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>


@endsection




 --}}
