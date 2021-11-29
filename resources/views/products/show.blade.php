@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12 col-lg-6 mt-5 mt-lg-0" style="background-color: white; display: flex; justify-content: center; align-items: center;">
        <img src="{{ asset('images/' . $product->image_path) }}" alt="Obrazok produktu" class="productDetailImg">
    </div>
    <div class="col-12 col-lg-6 productDetails">
        <h1 class="display-3">{{ $product->title }}</h1>
        <h3>cena: {{ $product->price }} €</h3>
        <h4>kategoria: {{ $category->category_name }}</h4>
        <h5>Popis produktu</h5>
        <p>{{ $product->description }}</p>
        <div class="d-grid gap-2 col-8 mx-auto mt-3">
            @if (\Illuminate\Support\Facades\Auth::check())
                <a href="{{ route('auth.product.addToCart', ['id' => $product->id]) }}" class="btn btn-success btn-lg" type="button">Pridat do kosika</a>
            @else
                <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-success btn-lg" type="button">Pridat do kosika</a>
            @endif
        </div>
    </div>
</div>

@endsection
