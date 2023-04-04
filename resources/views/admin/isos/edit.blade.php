@extends('admin.master')

@section('title', 'Alterar ISO')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/isos/1') }}"><i class="fa fa-flag"></i> ISO</a>
    </li>
    <li class="breadcrumb-item">
        <a href=""><i class="fa fa-edit"></i> Alterar ISO</a>
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
                    {!! Form::open(['url' => '/admin/iso/'.$p->id.'/edit']) !!}


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
