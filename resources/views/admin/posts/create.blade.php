@extends('admin.layout')

@section('contenido-header')
<h1>
    Posts
    <small>Crear Publicación</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Posts</a></li>
    <li class="active">Crear</li>
</ol>
@stop

@section('contenido')
<div class="row">
    <!-- inicio form -->
    <form action="">
        <!-- col 1 inicio --> 
        <div class="col-md-7">
            <div class="box box-info">
                <div class="box-body">
                    <div class="form-group">
                        <label for="título de la publicación">
                            Título de la Publicación
                        </label>
                        <input type="text" name="title" class="form-control" autofocus placeholder="Ingrese aquí el titulo de la publicación">
                    </div>
                    <div class="form-group">
                        <label for="extracto de la publicación">
                            Extracto de la Publicación
                        </label>
                        <input type="text" name="excerpt" class="form-control" autofocus placeholder="Ingrese aquí el extracto de la publicación">
                    </div>
                    <div class="form-group">
                        <label for="fecha de publicación">
                            Fecha de Publicación
                        </label>
                        <input type="text" name="publish_at" class="form-control" id="datepicker-publish_at" placeholder="Ingrese aquí la fecha de publicación">
                    </div>
                </div>
                <!-- fin .box-body -->
            </div>
        </div>
        <!-- col 1 fin -->          
        <!-- col 2 inicio -->          
        <div class="col-md-5">
            <div class="box box-info">
                <div class="box-body">
                    <div class="form-group">
                        <label for="categoria de la publicación">
                            Categorías
                        </label>
                        <select name="category_id" class="form-control">
                            <option>Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contenido de la publicación">
                            Contenido de la Publicación
                        </label>
                        <input type="text" name="body" class="form-control" autofocus placeholder="Ingrese aquí el contenido de la publicación">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Guardar Publicación" class="btn btn-block btn-primary">
                    </div>                    
                </div>
                <!-- fin .box-body -->
            </div>
        </div>
    </form>
    <!-- fin form -->
</div>
@stop

@push('styles')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
@endpush

@push('scripts')
<!-- bootstrap datepicker -->
<script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
//Date picker
$('#datepicker-publish_at').datepicker({
    autoclose: true
});
</script>
@endpush
