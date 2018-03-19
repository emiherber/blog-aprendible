@extends('admin.layout')

@section('contenido-header')
<h1>
    Usuarios
    <small>Crear Cuenta</small>
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
                        <div class="form-group {{ $errors->has('guard_name') ? 'has-error':'' }}">
                            <label for="guard_name">Guard</label>
                            <select name="guard_name" class="form-control">
                                @foreach(config('auth.guards') as $key => $value)
                                    <option 
                                        value="{{ $key }}"
                                        {{ old('guard_name') === $key ? 'selected' : ''}}
                                    >
                                        {{ $key }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('guard_name','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="permissions">Permisos</label>
                            @include('admin.permissions.checkboxes',['model' => $role])
                        </div>
                        <input type="submit" value="Nuevo Rol" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </dvi>
    </div>
@stop