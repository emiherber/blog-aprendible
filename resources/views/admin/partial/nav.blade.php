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
        </ul>
    </li>
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
</ul>