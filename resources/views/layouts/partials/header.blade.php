    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ route('coming-soon') }}"> <img src="{{ asset('img/logo.png') }}" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('coming-soon') }}">Inicio</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('coming-soon') }}">Sobre nosotros</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('coming-soon') }}">Contacto</a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                            @guest
                            <a href="{{ route('login') }}" class="nav-link p-0 mr-2" aria-label="Iniciar sesión">
                                <i class="fas fa-user"></i>
                            </a>
                            <a href="{{ route('register') }}" class="nav-link p-0 mr-2" aria-label="Registrarse">
                                <i class="fas fa-user-plus"></i>
                            </a>
                            @endguest

                            @auth
                                <a href="{{ route('profile.edit') }}" class="nav-link p-0 mr-2" aria-label="Iniciar sesión">
                                    <i class="fas fa-user"></i>
                                </a>
                            @endauth


                            <a href="{{ route('cart.index') }}" class="nav-link p-0" aria-label="Ver carrito">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->