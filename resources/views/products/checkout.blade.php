@extends('layouts.app')

@section('content')
    <!-- ROW -->
    <form class="row mb-5" action="{{ route('checkout') }}" method="POST" id="checkout-form">
        <!-- COLUMN 1 -->
        <div class="col-xl-6 col-12" style="background-color: white">
            <h2 class="display-6 signInHeading mt-5">Osobné a doručovacie údaje</h2>
            <div class="form-block">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="mb-2">E-mail</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte e-mail">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="mb-2 mt-2">Meno a priezvisko</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte meno a priezvisko">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="mb-2 mt-2">Adresa</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte adresu">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="mb-2 mt-2">Mesto</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte mesto">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="mb-2 mt-2">PSČ</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte PSČ">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="mb-2 mt-2">Telefónne číslo</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte telefónne číslo">
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
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Kuriér Slovenskej pošty (2.99 €)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        DHL kuríer (3.99 €)
                    </label>
                </div>
            </div>
            <h2 class="display-6 signInHeading mt-5">Platba</h2>
            <div class="form-block">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Platba kartou
                    </label>
                </div>
                <div class="ms-4">
                    <div class="form-group">
                        <label for="exampleInputName" class="mb-2">Číslo karty</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte číslo karty">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName" class="mb-2 mt-2">Platnosť karty</label>
                        <div class="putNextToEachOther">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Vyberte mesiac</option>
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                            </select>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Vyberte rok</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                                <option>24</option>
                                <option>25</option>
                                <option>26</option>
                                <option>27</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName" class="mb-2 mt-2">Overovací kód</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zadajte overovací kód">
                    </div>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Platba na dobierku
                    </label>
                </div>
                <button type="submit" class="btn btn-success mt-5">Dokončiť objednávku</button>
            </div>
        </div>
    </form>
@endsection
