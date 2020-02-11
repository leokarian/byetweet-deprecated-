<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{ route('inicio') }}" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Panel Principal
                    <!--<span class="badge badge-info right">2</span>-->
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('myTweets') }}" class="nav-link">
                <i class="nav-icon far fa-comment-dots"></i>
                <p>
                    Mis Tweets
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('meGusta') }}" class="nav-link">
                <i class="nav-icon fas fa-heart"></i>
                <p>
                    Me gusta
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('misSeguidores') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Seguidores
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('misSeguidos') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Siguiendo
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('prueba') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Prueba
                </p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->