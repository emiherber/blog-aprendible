@extends('admin.layout')

@section('contenido-header')
<h1>
    Usuarios
    <small>Crear Cuenta</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> Usuarios</a></li>
    <li class="active">Crear</li>
</ol>
@stop

@section('contenido')
    <div class="row">
         <dvi class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Datos Personales
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.users.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                            <label for="name">Nombre</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                value="{{ old('name')}}"
                                placeholder="Ingrese el nombre de usuario"
                                autofocus
                            >
                            {!! $errors->first('name','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error':'' }}">
                            <label for="email">Email</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="email" 
                                value="{{ old('email')}}"
                                placeholder="Ingrese el email del usuario"
                            >
                            {!! $errors->first('email','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="roles">Roles</label>
                            @include('admin.roles.checkboxes',['model' => $user])
                        </div>
                        <div class="form-group col-md-6">
                            <label for="permissions">Permisos</label>
                            @include('admin.permissions.checkboxes', ['model' => $user])
                        </div>
                        <span class="help-block">
                            La contraseña de sera generada y enviada vía email al nuevo usuario.
                        </span>
                        <input type="submit" value="Nuevo Usuario" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </dvi>
    </div>
@stop