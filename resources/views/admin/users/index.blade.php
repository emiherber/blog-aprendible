@extends('admin.layout')

@section('contenido-header')
<h1>
    Usuarios
    <small>Listado</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Usuarios</li>
</ol>
@stop


@section('contenido')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Listado de usuarios</h3>
        @can('create', auth()->user())
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i>
                Crear Usuario
            </a>
        @endcan
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="posts-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>E-mail</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                    <td>
                        @can('update', $user)
                            <a 
                                href="{{ route('admin.users.show', $user) }}" 
                                class="btn btn-default btn-xs"
                            >
                                <i class="fa fa-eye"></i>
                            </a>
                        @endcan
                        @can('delete', $user)
                            <a 
                                href="{{ route('admin.users.edit', $user) }}"
                                class="btn btn-info btn-xs">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form 
                                method="post" 
                                action="{{ route('admin.users.destroy', $user) }}" 
                                style="display: inline;"
                            >
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button 
                                    class="btn btn-danger btn-xs"
                                    onclick="return confirm('¿Esta seguro de eliminar el usuario?')"
                                >
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>  
                        @endcan                      
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