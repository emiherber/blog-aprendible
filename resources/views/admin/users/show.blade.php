@extends('admin.layout')

@section('contenido')
    <div class='col-md-3'>
        <!-- Profile Image -->
        <div class='box box-primary'>
            <div class='box-body box-profile'>
                <img 
                    class='profile-user-img img-responsive img-circle' 
                    src='/adminlte/img/user4-128x128.jpg' 
                    alt='{{ $user->name }}'
                >

                <h3 class='profile-username text-center'>{{ $user->name }}</h3>

                <p class='text-muted text-center'>{{ $user->getRoleNames()->implode('- ') }}</p>

                <ul class='list-group list-group-unbordered'>
                    <li class='list-group-item'>
                        <b>E-mail</b> <a class='pull-right'>{{ $user->email }}</a>
                    </li>
                    <li class='list-group-item'>
                        <b>Publicaciones</b> <a class='pull-right'>{{ $user->posts->count() }}</a>
                    </li>
                </ul>
                <a href='{{ route('admin.users.edit', $user) }}' class='btn btn-primary btn-block'>    <b>Editar</b>
                </a>
            </div>
        </div>
        <!-- /.box-body -->
    </div>    
    <div class='col-md-3'>
        <div class='box box-primary'>
            <div class='box-header with-border'>
                <h3 class='box-title'>Publicaciones: <small><b>Ultimas 10</b></small></h3>
            </div>
            <div class='box-body'>
                @forelse ($user->posts->take(10) as $post)
                    <a href="{{ route('posts.show', $post) }}" target='_blank'>
                        <strong>
                            {{ $post->title}}
                        </strong>
                    </a>
                    <br>
                    <small class='text-muted'>
                        Publicado el {{ $post->published_at->format('d/m/Y') }}
                    </small>
                    @unless($loop->last)
                        <hr>
                    @endunless
                @empty
                    <small class='text-muted'>
                        No tiene ninguna publicación asociada.
                    </small>
                @endforelse
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class='box box-primary'>
            <div class='box-header with-border'>
                <h3 class='box-title'>Roles</h3>
            </div>
            <div class='box-body'>
                @forelse ($user->roles as $role)
                    <strong>
                        {{ $role->name}}
                    </strong>
                    <br>
                    @if ($role->permissions->count() > 0)
                        <small class='text-muted'>
                            Permisos:
                            {{ $role->permissions->pluck('name')->implode(', ') }}
                        </small>
                    @endif
                    @unless($loop->last)
                        <hr>
                    @endunless
                @empty
                    <small class='text-muted'>
                        No tiene ningún rol asignado.
                    </small>
                @endforelse
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class='box box-primary'>
            <div class='box-header with-border'>
                <h3 class='box-title'>Permisos Adicionales</h3>
            </div>
            <div class='box-body'>
                @forelse ($user->permissions as $permission)
                    <strong>
                        {{ $permission->name}}
                    </strong>
                    @unless($loop->last)
                        <hr>
                    @endunless
                @empty
                    <small class='text-muted'>
                        No posee permisos adicionales
                    </small>
                @endforelse
            </div>
        </div>
    </div>  
@stop