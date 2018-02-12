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
    <form method="POST" action="{{ route('admin.posts.strore') }}">
        {{ csrf_field() }}
        <!-- col 1 inicio --> 
        <div class="col-md-7">
            <div class="box box-info">
                <div class="box-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error':'' }}">
                        <label for="título de la publicación">
                            Título de la Publicación
                        </label>
                        <input 
                            value="{{ old('title') }}"
                            type="text" 
                            name="title" 
                            class="form-control" 
                            autofocus placeholder="Ingrese aquí el titulo de la publicación">
                        {!! $errors->first('title','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{ $errors->has('body') ? 'has-error':'' }}">
                        <label for="contenido de la publicación">
                            Contenido de la Publicación
                        </label>
                        <textarea 
                            name="body" 
                            rows="10" 
                            id="editor" 
                            class="form-control" 
                            placeholder="Ingrese aquí el contenido de la publicación">{{ old('body') }}</textarea>
                        {!! $errors->first('body','<span class="help-block">:message</span>')!!}
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
                        <label for="fecha de publicación">
                            Fecha de Publicación
                        </label>
                        <input 
                            value="{{ old('published_at') }}"
                            type="text" 
                            name="published_at" 
                            class="form-control" 
                            id="datepicker-publish_at" 
                            placeholder="Ingrese aquí la fecha de publicación">
                    </div>
                    <div class="form-group {{ $errors->has('category') ? 'has-error':'' }}">
                        <label for="categoria de la publicación">
                            Categorías
                        </label>
                        <select name="category" class="form-control">
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                            <option 
                                {{ (old('category') == $categoria->id) ? 'selected': ''}}
                                value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('category','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{ $errors->has('tags') ? 'has-error':'' }}">
                        <label for="etiquetas de la publicación">
                            Etiquetas
                        </label>
                        <select 
                            name="tags[]"
                            multiple="multiple" 
                            class="form-control select2" 
                            data-placeholder="Seleccione una o más etiquetas" 
                            style="width: 100%;"
                        >
                            @foreach($tags as $tag)
                            <option 
                                {{ collect(old('tags'))->contains($tag->id) ? 'selected': ''}}
                                value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('tags','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{ $errors->has('excerpt') ? 'has-error':'' }}">
                        <label for="extracto de la publicación">
                            Extracto de la Publicación
                        </label>
                        <textarea 
                            name="excerpt" 
                            class="form-control" 
                            rows="3" 
                            style="resize: vertical;" 
                            placeholder="Ingrese aquí el extracto de la publicación">{{ old('excerpt') }}</textarea>
                        {!! $errors->first('excerpt','<span class="help-block">:message</span>')!!}
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
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
<!-- bootstrap datepicker -->
<script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<!-- Select2 -->
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>
<script>
//Date picker
$('#datepicker-publish_at').datepicker({
    autoclose: true
});

CKEDITOR.replace('editor');

$(".select2").select2();
</script>
@endpush
