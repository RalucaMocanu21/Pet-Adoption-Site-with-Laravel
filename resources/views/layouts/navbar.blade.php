<nav class="navbar {{ Request::is('/') ? 'navbar' : 'navbar-home' }}">
    <ul class="navbar-menu">
        <li><a href="/">Acasă</a></li>
        <li><a href="{{ route('animale.index') }}">Animale disponibile</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        @auth
            @if(Auth::user()->isAdmin())
                <li><a href="{{ route('statistici.postari') }}">Statistici postări</a></li>
                <li><a href="{{ route('statistici.cereri') }}">Statistici cereri</a></li>
            @endif
            @if(Auth::user()->hasRole('client'))
                <li><a href="{{ route('favorite.index') }}">Favorite</a></li>
                <li><a href="{{ route('cereri.index') }}">Cererile mele de adopție</a></li>
            @endif
            <li><a href="{{ route('logout') }}">Log out</a></li>
        @else
            <li><a href="{{ route('login') }}">Log in</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endauth
    </ul>
</nav>

