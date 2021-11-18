@extends('layouts.app')

@section('content')
    <main>
        <!-- ROW -->
        <section class="row" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <!-- COLUMN 1 -->
            <div class="col-12 col-md-10 col-xl-6" style="background-color: white">
                <h2 class="display-5 signInHeading mt-5">Pridanie nového produktu</h2>
                <form class="form-block" action="/products" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="mb-2">Názov produktu</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Zadajte názov" name="title">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1" class="mb-2 mt-2">Kategória produktu</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                            @foreach($product_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="mb-2 mt-2">Cena produktu (€)</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Zadajte cenu" name="price">
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-2 mb-2" for="customFile">Fotografia</label>
                        <input type="file" class="form-control" id="customFile" name="image"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="mt-2 mb-2">Popis produktu</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success mt-4 mb-5">Pridať produkt</button>
                </form>
            </div>
        </section>
    </main>
@endsection
