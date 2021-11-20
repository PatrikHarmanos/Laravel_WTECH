@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12 col-lg-6" style="background-color: white; display: flex; justify-content: center; align-items: center;">
        <img src="{{ asset('images/' . $product->image_path) }}" alt="Obrazok produktu" class="productDetailImg">
    </div>
    <div class="col-12 col-lg-6 productDetails">
        <h1 class="display-3">{{ $product->title }}</h1>
        <h3>cena: {{ $product->price }} €</h3>
        <h4>kategoria: {{ $category->category_name }}</h4>
        <form class="form-block" action="#" method="POST">
            <div class="form-group">
                <label for="exampleFormControlSelect1" class="mb-2 mt-2">Materiál produktu</label>
                <select class="form-control" id="exampleFormControlSelect1" name="material" >
                    <option value="plátno">plátno</option>
                    <option value="plagát">plagát</option>
                    <option value="lesklý plagát">lesklý plagát</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1" class="mb-2 mt-2">Materiál produktu</label>
                <select class="form-control" id="exampleFormControlSelect1" name="size" >
                    <option value="200x100">200x100</option>
                    <option value="400x300">400x300</option>
                    <option value="600x500">600x500</option>
                </select>
            </div>
        </form>
        <h5>Popis produktu</h5>
        <p>{{ $product->description }}</p>
        <div class="d-grid gap-2 col-8 mx-auto mt-3">
            <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-success btn-lg" type="button">Pridat do kosika</a>
        </div>
    </div>
</div>

@endsection
