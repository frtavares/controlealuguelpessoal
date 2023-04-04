@extends('admin.master')

@section('title', 'Incluir Cargo/Função')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/occupation/0') }}"><i class="fas fa-folder-open"></i> Cargo/Função</a>
    </li>

@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-edit"></i>  Editar Serviço</h2>
            </div>
            <div class="inside">
                {!! Form::open(['url' => '/admin/service/'.$cat->id.'/edit']) !!}

                <label for="name">Nome</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                    <i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::text('name', $occ->name , ['class' => 'form-control'] ) !!}
                </div>

                <label for="module" class="mtop16">Modulo</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i></span>
                    </div>
                {!! Form::select('module', getModulesArray(), $cat->module,['class' => 'custom-select']) !!}
                </div>

                

                {!! Form::submit('Editar', ['class' => 'btn btn-warning mtop16'])!!}

                {!! Form::close()!!}
            </div>
        </div>
        </div>



    </div>
</div>

@endsection
