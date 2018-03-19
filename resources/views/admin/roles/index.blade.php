@extends('admin.layout')

@section('contenido-header')
<h1>
    Roles
    <small>Listado de usuarios</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Roles</li>
</ol>
@stop


@section('contenido')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Lista de usuarios</h3>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i>
            Crear Rol
        </a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="posts-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Guard</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    <td>
                        <a 
                            href="{{ route('admin.roles.show', $role) }}" 
                            class="btn btn-default btn-xs"
                        >
                            <i class="fa fa-eye"></i>
                        </a>
                        <a 
                        href="{{ route('admin.roles.edit', $role) }}"
                            class="btn btn-info btn-xs">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <form 
                            method="post" 
                            action="{{ route('admin.roles.destroy', $role) }}" 
                            style="display: inline;"
                        >
                            {{ csrf_field() }} {{ method_field('delete') }}
                            <button 
                                class="btn btn-danger btn-xs"
                                onclick="return confirm('¿Esta seguro de eliminar el rol?')"
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