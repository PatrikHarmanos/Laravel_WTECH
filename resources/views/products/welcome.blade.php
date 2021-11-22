@extends('layouts.app')

@section('content')
    <!-- MAIN CAROUSEL -->
    <article id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="overlay-image" style="background-image: url('{{asset('images/history.jpg')}}');"></div>
                <div class="container main-carousel-container">
                    <div class="carousel-caption text-start">
                        <h1>História na dosah.</h1>
                        <p>Preskúmajte diela, ktoré majú v sebe históriu a príbehy.</p>
                        <p><a class="btn btn-lg btn-success" href="#">Zistiť viac</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="overlay-image" style="background-image: url('{{asset('images/modern.jpg')}}');"></div>
                <div class="container main-carousel-container">
                    <div class="carousel-caption">
                        <h1>Nahliadnite do budúcnosti.</h1>
                        <p>Najnovšie kolekcie moderného umenia od svetových umelcov.</p>
                        <p><a class="btn btn-lg btn-success" href="#">Zistiť viac</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="overlay-image" style="background-image: url('{{asset('images/photo.jpg')}}');"></div>
                <div class="container main-carousel-container">
                    <div class="carousel-caption text-end">
                        <h1>Fotografie ako umenie.</h1>
                        <p>Poďte s nami nahliadnuť do sveta ďaleko za objektívom.</p>
                        <p><a class="btn btn-lg btn-success" href="#">Zistiť viac</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </article>

    <!-- SECTION -->
    <section class="container mt-5 mb-5">
        <h2 class="mb-3">Najpredávanejšie produkty</h2>
        <!-- FIRST ROW -->
        <div class="row mb-5">
            @foreach($productsOne as $item)
            <div class="col-md-3 col-sm-6 mb-sm-5 mb-5">
                <div class="card">
                    <div class="img-wrapper">
                        <img class="card-img-top" src="{{ asset('images/' . $item->image_path) }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text text-secondary">{{ $item->price }} €</p>
                        <a href="products/{{ $item->id }}/" class="btn btn-success btn-block">Zobraziť produkt</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h2 class="mb-3">Novinky</h2>
        <!-- SECOND ROW -->
        <div class="row mb-5">
            @foreach($productsTwo as $item)
                <div class="col-md-3 col-sm-6 mb-sm-5 mb-5">
                    <div class="card">
                        <div class="img-wrapper">
                            <img class="card-img-top" src="{{ asset('images/' . $item->image_path) }}" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text text-secondary">{{ $item->price }} €</p>
                            <a href="products/{{ $item->id }}/" class="btn btn-success btn-block">Zobraziť produkt</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
