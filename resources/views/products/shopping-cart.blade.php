@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::check() && $products)
        <section class="pb-5">
            <!-- jumbotron with cart name -->
            <div class="jumbotron jumbotron-fluid bg-success">
                <div class="container pt-4 pb-4">
                    <h1 class="display-4 text-center text-white">Nákupný košík</h1>
                </div>
            </div>
            <div class="container">
                <div class="row w-100">
                    <div class="col-lg-12 col-md-12 col-12">

                        <p class="mt-3 mb-5 text-center" style="font-size: x-large;">
                            Počet položiek v košíku:
                            <i class="text-success font-weight-bold">{{ $totalQty }}</i>
                        </p>
                        <table id="shoppingCart" class="table table-condensed table-responsive">
                            <thead>
                            <tr>
                                <th style="width:60%">Produkt</th>
                                <th style="width:12%">Cena</th>
                                <th style="width:10%">Množstvo</th>
                                <th style="width:16%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-md-3 text-left">
                                                <img src="{{ asset('images/' . $product->image_path) }}" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow " style="height: 120px; width: 100px;">
                                            </div>
                                            <div class="col-md-9 text-left mt-sm-2">
                                                <h4>{{ $product->title }}</h4>
                                                <p class="font-weight-light">Kategória: {{ $product->category_id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">{{ $product->price }} €</td>
                                    <td data-th="Quantity">
                                        <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-around;">
                                            <a class="btn btn-white border-secondary bg-white btn-md mb-2" href="{{ route('auth.product.minusOneToCart', ['id' => $product->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                </svg>
                                            </a>
                                            <p>{{ $quantity[$product->id] }}</p>
                                            <a class="btn btn-white border-secondary bg-white btn-md mb-2" href="{{ route('auth.product.plusOneToCart', ['id' => $product->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="actions" data-th="">
                                        <div class="text-right">
                                            <a class="btn btn-white border-secondary bg-white btn-md mb-2" href="{{ route('auth.product.removeFromCart', ['id' => $product->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="float-right text-right">
                            <h4>Spolu:</h4>
                            <h1>{{ $totalPrice }} €</h1>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 d-flex align-items-center">
                    <div class="col-sm-6 order-md-2 text-right">
                        <a href="{{ route('checkout') }}" class="btn btn-success mb-4 btn-lg pl-5 pr-5">Prejsť na platbu a doručenie</a>
                    </div>
                    <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                        <a href="{{ route('products.index') }}">
                            <i class="fas fa-arrow-left mr-2"></i>Pokračovať v nákupe</a>
                    </div>
                </div>
            </div>
        </section>
        @elseif(\Illuminate\Support\Facades\Session::has('cart'))
        <section class="pb-5">
            <!-- jumbotron with cart name -->
            <div class="jumbotron jumbotron-fluid bg-success">
                <div class="container pt-4 pb-4">
                    <h1 class="display-4 text-center text-white">Nákupný košík</h1>
                </div>
            </div>
            <div class="container">
                <div class="row w-100">
                    <div class="col-lg-12 col-md-12 col-12">

                        <p class="mt-3 mb-5 text-center" style="font-size: x-large;">
                            Počet položiek v košíku:
                            <i class="text-success font-weight-bold">{{ $totalQty }}</i>
                        </p>
                        <table id="shoppingCart" class="table table-condensed table-responsive">
                            <thead>
                            <tr>
                                <th style="width:60%">Produkt</th>
                                <th style="width:12%">Cena</th>
                                <th style="width:10%">Množstvo</th>
                                <th style="width:16%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-md-3 text-left">
                                                <img src="{{ asset('images/' . $product['item']['image_path']) }}" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow " style="height: 120px; width: 100px;">
                                            </div>
                                            <div class="col-md-9 text-left mt-sm-2">
                                                <h4>{{ $product['item']['title'] }}</h4>
                                                <p class="font-weight-light">Kategória: {{ $product['item']['category_id'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">{{ $product['price'] }} €</td>
                                    <td data-th="Quantity">
                                        <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-around;">
                                            <a class="btn btn-white border-secondary bg-white btn-md mb-2" href="{{ route('product.minusOneToCart', ['id' => $product['item']['id']]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                </svg>
                                            </a>
                                            <p>{{ $product['qty'] }}</p>
                                            <a class="btn btn-white border-secondary bg-white btn-md mb-2" href="{{ route('product.plusOneToCart', ['id' => $product['item']['id']]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="actions" data-th="">
                                        <div class="text-right">
                                            <a class="btn btn-white border-secondary bg-white btn-md mb-2" href="{{ route('product.removeFromCart', ['id' => $product['item']['id']]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="float-right text-right">
                            <h4>Spolu:</h4>
                            <h1>{{ $totalPrice }} €</h1>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 d-flex align-items-center">
                    <div class="col-sm-6 order-md-2 text-right">
                        <a href="{{ route('checkout') }}" class="btn btn-success mb-4 btn-lg pl-5 pr-5">Prejsť na platbu a doručenie</a>
                    </div>
                    <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                        <a href="{{ route('products.index') }}">
                            <i class="fas fa-arrow-left mr-2"></i>Pokračovať v nákupe</a>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="pb-5">
            <!-- jumbotron with cart name -->
            <div class="jumbotron jumbotron-fluid bg-success">
                <div class="container pt-4 pb-4">
                    <h1 class="display-4 text-center text-white">Nákupný košík</h1>
                </div>
            </div>
            <div class="container">
                <div class="row w-100">
                    <div class="col-lg-12 col-md-12 col-12">
                        <p class="mt-3 mb-5 text-center" style="font-size: x-large;">
                            Nákupný košík je prázdny.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
