<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-brand">Fogstream</div>
        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : ''  }}" aria-current="page" href="{{ route('home') }}">Главная</a>
                </li>
            @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('users') || request()->is('users/search') ? 'active' : ''  }}" aria-current="page" href="{{ route('user.users') }}">Пользователи</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('user.show', Auth::user()->id) }}" class="nav-link">{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-success" href="{{ route('user.logout') }}">Выйти</a>
                </li>
            </ul>
            @else
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-outline-success" href="{{ route('user.login') }}">Войти</a>
                </li>
            </ul>
            @endif
        </div>
        </div>
    </div>
</nav>