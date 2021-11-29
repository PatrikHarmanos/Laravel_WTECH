@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::check())
        <!-- ROW -->
        <form class="row mb-5" action="{{ route('auth.finishOrder') }}" method="GET" id="checkout-form">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <!-- COLUMN 1 -->
            <div class="col-xl-6 col-12" style="background-color: white">
                <h2 class="display-6 signInHeading mt-5">Osobné a doručovacie údaje</h2>
                @if ($errors->any())
                    <div class="alert alert-danger mt-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-block">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2">E-mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte e-mail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">Meno a priezvisko</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte meno a priezvisko" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">Adresa</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte adresu" name="address">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">Mesto</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte mesto" name="city">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">PSČ</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte PSČ" name="psc">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">Telefónne číslo</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte telefónne číslo" name="number">
                    </div>
                    <h4 class="mt-5">Spolu:</h4>
                    <h1>{{ $totalPrice }} €</h1>
                </div>
            </div>
            <!-- COLUMN 2 -->
            <div class="col-xl-6 col-12" style="background-color: white;">
                <h2 class="display-6 signInHeading mt-5">Doprava</h2>
                <div class="form-block">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="delivery" value="post_office" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Kuriér Slovenskej pošty (2.99 €)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delivery" value="dhl" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            DHL kuríer (3.99 €)
                        </label>
                    </div>
                </div>
                <h2 class="display-6 signInHeading mt-5">Platba</h2>
                <div class="form-block">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment" value="card" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Platba kartou
                        </label>
                    </div>
                    <div class="ms-4">
                        <div class="form-group">
                            <label for="exampleInputName" class="mb-2">Číslo karty</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte číslo karty" name="card_number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName" class="mb-2 mt-2">Platnosť karty</label>
                            <div class="putNextToEachOther">
                                <select class="form-control" id="exampleFormControlSelect1" name="card_month">
                                    <option value="">Vyberte mesiac</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <select class="form-control" id="exampleFormControlSelect1" name="card_year">
                                    <option value="">Vyberte rok</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName" class="mb-2 mt-2">Overovací kód</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte overovací kód" name="card_csv">
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="payment" value="cash" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Platba na dobierku
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success mt-5">Dokončiť objednávku</button>
                </div>
            </div>
        </form>
    @elseif(\Illuminate\Support\Facades\Session::has('cart'))
        <!-- ROW -->
        <form class="row mb-5" action="{{ route('finishOrder') }}" method="GET" id="checkout-form">
            <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <!-- COLUMN 1 -->
            <div class="col-xl-6 col-12" style="background-color: white">
                <h2 class="display-6 signInHeading mt-5">Osobné a doručovacie údaje</h2>
                @if ($errors->any())
                    <div class="alert alert-danger mt-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-block">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2">E-mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte e-mail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">Meno a priezvisko</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte meno a priezvisko" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">Adresa</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte adresu" name="address">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">Mesto</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte mesto" name="city">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">PSČ</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte PSČ" name="psc">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2 mt-2">Telefónne číslo</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte telefónne číslo" name="number">
                    </div>
                    <h4 class="mt-5">Spolu:</h4>
                    <h1>{{ $totalPrice }} €</h1>
                </div>
            </div>
            <!-- COLUMN 2 -->
            <div class="col-xl-6 col-12" style="background-color: white;">
                <h2 class="display-6 signInHeading mt-5">Doprava</h2>
                <div class="form-block">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="delivery" value="post_office" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Kuriér Slovenskej pošty (2.99 €)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delivery" value="dhl" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            DHL kuríer (3.99 €)
                        </label>
                    </div>
                </div>
                <h2 class="display-6 signInHeading mt-5">Platba</h2>
                <div class="form-block">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment" value="card" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Platba kartou
                        </label>
                    </div>
                    <div class="ms-4">
                        <div class="form-group">
                            <label for="exampleInputName" class="mb-2">Číslo karty</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte číslo karty" name="card_number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName" class="mb-2 mt-2">Platnosť karty</label>
                            <div class="putNextToEachOther">
                                <select class="form-control" id="exampleFormControlSelect1" name="card_month">
                                    <option value="">Vyberte mesiac</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <select class="form-control" id="exampleFormControlSelect1" name="card_year">
                                    <option value="">Vyberte rok</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName" class="mb-2 mt-2">Overovací kód</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte overovací kód" name="card_csv">
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="payment" value="cash" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Platba na dobierku
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success mt-5">Dokončiť objednávku</button>
                </div>
            </div>
        </form>
    @endif
@endsection
