@extends('admin.master')

@section('title', 'Cargo/Função')

@section('breadcrumb')
<ol class="breadcrumb-item">
    <a href="{{ url('/admin/occupations/0') }}"><i class="fas fa-cog"></i> Cargo/Função</a>
</ol>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="title"><i class="fas fa-cog"></i> Incluir Cargo/Função</a>
                </div>
                <div class="card-body">
                    @if(kvfj(Auth::user()->permissions, 'occupation_add'))
                    {!! Form::open(['url' => '/admin/occupation/add']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Cargo/Função</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i></span>
                                    </div>
                                    {!! Form::text('name', null, ['class' => 'form-control'] ) !!}  

                                    <div class="container-fluid"></div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::submit('Salvar', ['class' => 'btn btn-success'])!!}
                                        </div>
                                    </div>
                                    {!! Form::close()!!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
