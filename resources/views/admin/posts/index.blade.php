@extends('admin.layout')

@section('contenido-header')
<h1>
    Posts
    <small>Listado de Publicaciones</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Posts</li>
</ol>
@stop


@section('contenido')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Lista de publicaciones</h3>
        <button 
            class="btn btn-primary pull-right"
            data-toggle="modal" 
            data-target="#myModal"
            tabindex="-1"
        >
            <i class="fa fa-plus"></i>
            Crear Publicación
        </button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="posts-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        <a 
                            href="{{ route('posts.show', $post) }}" 
                            class="btn btn-default btn-xs"
                            target="_blank"
                        >
                            <i class="fa fa-eye"></i>
                        </a>
                        <a 
                        href="{{ route('admin.posts.edit', $post) }}"
                            class="btn btn-info btn-xs">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <form 
                            method="post" 
                            action="{{ route('admin.posts.destroy', $post) }}" 
                            style="display: inline;"
                        >
                            {{ csrf_field() }} {{ method_field('delete') }}
                            <button 
                                class="btn btn-danger btn-xs"
                                onclick="return confirm('¿Esta seguro de eliminar la publicación?')"
                            >
                                <i class="fa fa-times"></i>
                            </button>
                        </form>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@stop

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(function () {
    $('#posts-table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});
</script>
@endpush