<ul class="sidebar-menu">
    <li class="header">Navegación</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ setActiveRoute('admin') }}">
        <a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> <span>Inicio</span></a>
    </li>
    <li class="treeview {{ setActiveRoute('admin.posts.index') }}">
        <a href="#"><i class="fa fa-bars"></i> <span>Blog</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setActiveRoute('admin.posts.index') }}">
                <a href="{{ route('admin.posts.index') }}"><i class="fa fa-eye"></i> Ver Posts</a>
            </li>
            @can('create', new App\Post)
                <li class="{{ request()->is('admin/posts/create') ? 'active' : ''}}">
                    @if(request()->is('admin/posts/*'))
                        <a href="{{ route('admin.posts.index', '#create') }}">
                            <i class="fa fa-pencil"></i> 
                            Crear Post
                        </a>
                    @else
                        <a 
                            href="#" 
                            data-toggle="modal" 
                            data-target="#myModal"
                            tabindex="-1"
                        >
                            <i class="fa fa-pencil"></i> 
                            Crear Post
                        </a>
                    @endif
                </li>
            @endcan
        </ul>
    </li>
    @can('create', auth()->user())
        <li class="treeview {{ setActiveRoute(['admin.users.index','admin.users.create']) }}">
            <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ setActiveRoute('admin.users.index') }}">
                    <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver Usuarios</a>
                </li>
                <li class="{{ setActiveRoute('admin.users.create') }}">
                    <a href="{{ route('admin.users.create') }}">
                        <i class="fa fa-pencil"></i> 
                        Crear Usuario
                    </a>
                </li>            
            </ul>
        </li>
    @else
       <li class="treeview {{ setActiveRoute(['admin.users.show','admin.users.edit']) }}">
            <a href="{{ route('admin.users.show', auth()->user()) }}">
                <i class="fa fa-user"></i> <span>Perfil</span>
            </a>
        </li> 
    @endcan
    @can('view', new \Spatie\Permission\Models\Role)
        <li class="treeview {{ setActiveRoute(['admin.roles.index','admin.roles.edit']) }}">
            <a href="{{ route('admin.roles.index') }}"><i class="fa fa-user-secret">                
                </i> <span>Roles</span>
            </a>
        </li>
    @endcan
    @can('view', new \Spatie\Permission\Models\Permission)
        <li class="treeview {{ setActiveRoute(['admin.permissions.index','admin.permissions.edit']) }}">
            <a href="{{ route('admin.permissions.index') }}">
                <i class="fa fa-shield"></i> <span>Permisos</span>
            </a>
        </li>
    @endcan
</ul>