@extends('admin.layout')

@section('contenido-header')
<h1>
    Usuarios
    <small>Actualizar Cuenta</small>
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
                    <form action="{{ route('admin.users.update',$user) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                            <label for="name">Nombre</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                value="{{ old('name', $user->name)}}"
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
                                value="{{ old('email', $user->email)}}"
                                placeholder="Ingrese el email del usuario"
                            >
                            {!! $errors->first('email','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error':'' }}">
                            <label for="password">Contraseña</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                name="password" 
                                placeholder="Ingrese el Contraseña del usuario"
                            >
                            <span class="help-block">
                                Dejar en blanco para no cambiar la Contraseña.
                            </span>
                            {!! $errors->first('password','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                name="password_confirmation" 
                                placeholder="Repite la Contraseña del usuario"
                            >
                        </div>
                        <input type="submit" value="Actualizar Usuario" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </dvi>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles</h3>
                </div>
                <div class="box-body">
                    @role('Admin')
                        <form action="{{ route('admin.users.roles.update', $user) }}" method="post">
                            {{ csrf_field() }} {{ method_field('PUT') }}
                            @include('admin.roles.checkboxes')
                            <input type="submit" value="Actualizar Roles" class="btn btn-primary btn-block">
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse($user->roles as $role)
                                <li class="list-group-item">{{ $role->name }}</li>
                            @empty
                                <li class="list-group-item">No tiene roles</li>
                            @endforelse
                        </ul>
                    @endrole
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permisos</h3>
                </div>
                <div class="box-body">
                    @role('Admin')
                        <form action="{{ route('admin.users.permissions.update', $user) }}" method="post">
                            {{ csrf_field() }} {{ method_field('PUT') }}
                            @include('admin.permissions.checkboxes', ['model' => $user])
                            <input type="submit" value="Actualizar Permisos" class="btn btn-primary btn-block">
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse($user->permissions as $permission)
                                <li class="list-group-item">{{ $permission->name }}</li>
                            @empty
                                <li class="list-group-item">No tiene permisos</li>
                            @endforelse
                        </ul>
                    @endrole
                </div>
            </div>
        </div>        
    </div>
@stop