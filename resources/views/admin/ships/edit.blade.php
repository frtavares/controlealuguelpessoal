@extends('admin.master')

@section('title', 'Incluir Navio')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ships/1') }}"><i class="fa fa-ship"></i> Navio</a>
    </li>
    <li class="breadcrumb-item">
        <a href=""><i class="fa fa-edit"></i> Alterar Navio</a>
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
                    {!! Form::open(['url' => '/admin/ship/'.$p->id.'/edit']) !!}


                    <div class="col-md-4">
                        <label for="name">Nome</label>
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
