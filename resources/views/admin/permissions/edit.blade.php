@extends('admin.layout')

@section('contenido-header')
<h1>
    Permisos
    <small>Editar Permisos</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ route('admin.permissions.index') }}"><i class="fa fa-users"></i> Permisos</a></li>
    <li class="active">Editar</li>
</ol>
@stop

@section('contenido')
    <div class="row">
         <dvi class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Editar Rol
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.permissions.update', $permission) }}" method="post">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="identificador">Identificador</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                value="{{ $permission->name }}"
                                placeholder="Ingrese el identificador del rol"
                                disabled
                            >
                        </div>
                        <div class="form-group {{ $errors->has('display_name') ? 'has-error':'' }}">
                            <label for="display_name">Nombre</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="display_name" 
                                value="{{ old('display_name', $permission->display_name)}}"
                                placeholder="Ingrese el nombre del permiso"
                                autofocus
                            >
                            {!! $errors->first('display_name','<span class="help-block">:message</span>')!!}
                        </div>
                        <input type="submit" value="Editar Permiso" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </dvi>
    </div>
@stop