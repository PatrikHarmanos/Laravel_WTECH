@extends('layouts.app')

@section('content')
    <!-- selected category jumbotron -->
    <article class="jumbotron jumbotron-fluid bg-success">
        <div class="container pt-4 pb-4">
            <h1 class="display-4 text-center text-white">{{ $category }}</h1>
        </div>
    </article>
    <!-- pick categories buttons -->
    <section class="btn-toolbar d-flex justify-content-center mt-4 mb-2" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group me-3" role="group" aria-label="First group">
            <form method="GET" action="{{ route('products.index') }}">
                <button type="submit" name="category" value="Moderné umenie" class="btn btn-outline-dark customBtnWidth mb-3">Moderné umenie</button>
            </form>
        </div>
        <div class="btn-group me-3" role="group" aria-label="First group">
            <form method="GET" action="{{ route('products.index') }}">
                <button type="submit" name="category" value="Historické obrazy" class="btn btn-outline-dark customBtnWidth mb-3">Historické obrazy</button>
            </form>
        </div>
        <div class="btn-group me-3" role="group" aria-label="First group">
            <form method="GET" action="{{ route('products.index') }}">
                <button type="submit" name="category" value="Príroda" class="btn btn-outline-dark customBtnWidth mb-3">Príroda</button>
            </form>
        </div>
        <div class="btn-group me-3" role="group" aria-label="First group">
            <form method="GET" action="{{ route('products.index') }}">
                <button type="submit" name="category" value="Zátišia" class="btn btn-outline-dark customBtnWidth mb-3">Zátišia</button>
            </form>
        </div>
        <div class="btn-group me-3" role="group" aria-label="First group">
            <form method="GET" action="{{ route('products.index') }}">
                <button type="submit" name="category" value="Architektúra" class="btn btn-outline-dark customBtnWidth mb-3">Architektúra</button>
            </form>
        </div>
        <div class="btn-group me-3" role="group" aria-label="First group">
            <form method="GET" action="{{ route('products.index') }}">
                <button type="submit" name="category" value="Fotografie" class="btn btn-outline-dark customBtnWidth mb-3">Fotografie</button>
            </form>
        </div>
    </section>

    <!-- filter products dropdowns -->
    <section class="btn-toolbar d-flex justify-content-center mb-2" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group me-3" role="group" aria-label="First group">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-danger dropdown-toggle mb-3 customBtnWidthSmaller" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Cena
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#">do 20€</a>
                <a class="dropdown-item" href="#">20€ - 50€</a>
                <a class="dropdown-item" href="#">nad 50€</a>
            </div>
        </div>
        <div class="btn-group me-3" role="group" aria-label="First group">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-danger dropdown-toggle mb-3 customBtnWidthSmaller" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Zoradiť podľa
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#">Najdrahšie</a>
                <a class="dropdown-item" href="#">Najlacnejšie</a>
                <a class="dropdown-item" href="#">Najnovšie</a>
            </div>
        </div>
        <div class="btn-group me-3" role="group" aria-label="First group">
            <a type="button" class="btn btn-outline-dark customBtnWidth mb-3" href="products/create">Pridat produkt</a>
        </div>
    </section>

    <!-- products -->
    <section class="container mt-5">

        <!-- FIRST ROW -->
        <div class="row">
            @forelse($products as $item)
            <div class="col-md-3 col-sm-6 mb-sm-5 mb-5">
                <div class="card">
                    <div class="img-wrapper">
                        <img class="card-img-top" src="{{ asset('images/' . $item->image_path) }}" alt="obrázok Príroda sa prebúdza">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text text-secondary">{{ $item->price }} €</p>
                        <div style="display: flex; flex-direction: row; justify-content: space-between;">
                            <a href="products/{{ $item->id }}/" class="btn btn-success btn-block">Zobraziť produkt</a>

                            <form action="{{url('products', [$item->id])}}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-white border-secondary bg-white btn-md" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>
                            <a class="btn btn-white border-secondary bg-white btn-md" href="products/{{ $item->id }}/edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center">
                    Pre hladany vyraz <strong>{{ request()->query('search') }}</strong> sa nenasli ziadne vysledky.
                </p>
            @endforelse
        </div>

        {{ $products->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </section>

@endsection
