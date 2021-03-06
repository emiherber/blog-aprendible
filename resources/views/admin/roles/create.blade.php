@extends('admin.layout')

@section('contenido-header')
<h1>
    Roles
    <small>Crear Rol</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ route('admin.roles.index') }}"><i class="fa fa-users"></i> Roles</a></li>
    <li class="active">Crear</li>
</ol>
@stop

@section('contenido')
    <div class="row">
         <dvi class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Crear Rol
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.roles.store') }}" method="post">
                        @include('admin.roles.form')
                        <input type="submit" value="Nuevo Rol" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </dvi>
    </div>
@stop