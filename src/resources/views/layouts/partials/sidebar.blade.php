<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img
            src="{{ asset('icon.png') }}" alt="Foodable logo"
            class="brand-image img-circle elevation-3" style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">
            <b>Foodable</b>
        </span>
    </a>
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a
                        class="nav-link @if (request()->is('/') || request()->is('restaurant')) active @endif"
                        href="{{ route('home') }}"
                    >
                        <i class="fas fa-fw fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link @if (request()->is('profile')) active @endif"
                        href="{{ route('profile.edit') }}"
                    >
                        <i class="fas fa-fw fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
