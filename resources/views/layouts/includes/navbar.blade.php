<nav class="navbar navbar-expand-md navbar-light justify-content-center">
    <div class="container align-items-start d-block">
        <div class="d-flex">
            <img src="{{asset('assets/img/logo.png')}}" alt="Logo MercadoClone" style="max-width:75px;max-height:51px">
            <a class="navbar-brand" href="/">
                <p class="pt-1 font-weight-bold">MercadoClone</p>
            </a>

            @unless(Request::is('login') OR Request::is('register'))
                <form class="form-inline pb-3" method="GET" action="/classified/search">
                    <input class="form-control flex-grow-1" type="search" name="query" placeholder="Buscar publicaciones..."
                           aria-label="Busqueda">
                    <button class="btn"><i class="fa fa-search"></i></button>
                </form>
            @endunless
        </div>

        @unless(Request::is('login') OR Request::is('register'))

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link lr-border " href="#">Populares</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lr-border" href="#">Más recientes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link lr-border" href="#">Ayuda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link lr-border" href="#">Contactanos</a>
                    </li>
                </ul>

                @if (Route::has('login'))
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item dropdown lr-border">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    Usuario
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/userinfo">Informacion de Usuario</a>
                                    <a class="dropdown-item" href="{{ route('purchase.index', ['item' => 'bought']) }}">Compras</a>
                                    <a class="dropdown-item" href="{{ route('questions.index', ['mode' => 'asked']) }}">Preguntas Realizadas</a>
                                    <a class="dropdown-item" href="{{ route('purchase.index', ['item' => 'sold']) }}">Ventas</a>
                                    <a class="dropdown-item" href="{{ route('questions.index', ['mode' => 'received']) }}">Preguntas Recibidas</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link lr-border " href="/classified/create">Vender</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link lr-border" href="/userinfo/favorites">Favoritos</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link lr-border" href="{{ route('login') }}">Iniciar Sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link lr-border" href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                @endif
            </div>
        @endunless
    </div>
</nav>
