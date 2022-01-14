<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-brand">Fogstream</div>
        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : ''  }}" aria-current="page" href="{{ route('home') }}">Главная</a>
                </li>
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('users') ? 'active' : ''  }}" aria-current="page" href="{{ route('user.users') }}">Пользователи</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-success" href="{{ route('user.logout') }}">Выйти</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-success" href="{{ route('user.login') }}">Войти</a>
                    </li>
                @endif
            </ul>
        </div>
        </div>
    </div>
</nav>