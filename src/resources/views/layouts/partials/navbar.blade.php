<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
                <span class="sr-only">Toggle navigation</span>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span>Yuta Kikkawa</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li>
                    <a href="{{ route('profile.edit') }}" class="btn-default dropdown-item">
                        <i class="fa fa-fw fa-user"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="btn-default dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off"></i>
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

@push('style')
    <style>
        .navbar-nav > .user-menu > .dropdown-menu {
            width: 200px;
        }

        .dropdown-menu-lg {
            min-width: 200px;
        }
    </style>
@endpush
