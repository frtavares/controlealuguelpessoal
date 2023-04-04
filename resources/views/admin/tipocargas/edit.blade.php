@extends('admin.master')

@section('title', 'Alterar Tipo Carga')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/tipocargas/1') }}"><i class="fa fa-boxes"></i> Tipo Carga</a>
    </li>
    <li class="breadcrumb-item">
        <a href=""><i class="fa fa-edit"></i> Alterar Tipo Carga</a>
    </li>

@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel shadow">
                <div class="header">

                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/admin/tipocarga/'.$p->id.'/edit']) !!}


                    <div class="col-md-4">
                        <label for="uf">Descrição</label>
                        <div class="input-group">
                            <div class="input-group-prepend">

                            </div>
                            {!! Form::text('name', $p->name , ['class' => 'form-control'] ) !!}
                        </div>
                    </div>

                    {!! Form::submit('Alterar', ['class' => 'btn btn-warning mtop16'])!!}
                    {!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
