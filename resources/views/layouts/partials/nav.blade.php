<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand ms-lg-5 ms-sm-3 me-xl-5 fs-4 fw-bold" href="#">ArtStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-xl-5" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-5">
                <li class="nav-item me-lg-4">
                    <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Domov</a>
                </li>
                <li class="nav-item dropdown me-lg-4">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kategórie
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/products">Všetky kategórie</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <form method="GET" action="{{ route('products.index') }}">
                            <button type="submit" name="category" value="Moderné umenie" class="dropdown-item">Moderné umenie</button>
                            <button type="submit" name="category" value="Historické obrazy" class="dropdown-item">Historické obrazy</button>
                            <button type="submit" name="category" value="Príroda" class="dropdown-item">Príroda</button>
                            <button type="submit" name="category" value="Zátišia" class="dropdown-item">Zátišia</button>
                            <button type="submit" name="category" value="Architektúra" class="dropdown-item">Architektúra</button>
                            <button type="submit" name="category" value="Fotografie" class="dropdown-item">Fotografie</button>
                        </form>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/products">Výpredaj</a>
                </li>
            </ul>
            <form class="d-flex me-xl-5" method="GET" action="{{ route('products.index') }}">
                <input class="form-control me-2" type="search" name="search" placeholder="Vyhľadávanie" aria-label="Search" value="{{ request()->query('search') }}">
                <button class="btn btn-success" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </form>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-xl-5 ms-lg-4">
                @if (\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item me-lg-4">
                        <!-- Sign In button -->
                        <a class="nav-link active" aria-current="page" href="{{ route('profile') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </a>
                    </li>
                @else
                    <li class="nav-item me-lg-4">
                        <!-- Sign In button -->
                        <a class="nav-link active" aria-current="page" href="{{ route('register') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <!-- cart button -->
                    @if (\Illuminate\Support\Facades\Auth::check())
                        <a class="nav-link active" aria-current="page" href="{{ route('auth.product.shoppingCart') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <span class="badge"></span>
                        </a>
                    @else
                        <a class="nav-link active" aria-current="page" href="{{ route('product.shoppingCart') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <span class="badge">{{ \Illuminate\Support\Facades\Session::has('cart') ? \Illuminate\Support\Facades\Session::get('cart')->totalQty : '' }}</span>
                        </a>
                    @endif
                </li>
                @if (\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item ms-xl-5">
                        <!-- logout button -->
                        <a class="nav-link active" aria-current="page" href="{{ route('logout.perform') }}">
                            Odhlásiť sa
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
