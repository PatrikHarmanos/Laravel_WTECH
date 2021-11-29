@extends('layouts.app')

@section('content')
    <div class="container pb-4">

        <div class="card cardProfile mt-5 mb-5">
            <img src="{{ asset('images/shrek.jpeg') }}" alt="John" style="width:100%">
            <h1>{{ $user->name }}</h1>
            <p class="title">{{ $user->email }}</p>
        </div>

        <h3 class="mb-3">Objednávky:</h3>
        @foreach($orders as $order)

            <table class="profileTable mb-5">
                <tr>
                    <th class="profileBelow">Dátum</th>
                    <th class="profileBelow">Meno a priezvisko</th>
                    <th class="profileBelow">Adresa</th>
                    <th class="profileBelow">Celková cena</th>
                </tr>
                <tr>
                    <td class="profileBelow">{{ $order->created_at }}</td>
                    <td class="profileBelow">{{ $order->name }}</td>
                    <td class="profileBelow">{{ $order->address }}, {{ $order->city }}</td>
                    <td class="profileBelow">{{ $order->totalPrice }} eur</td>
                </tr>
            </table>

        @endforeach

        {{ $orders->links('pagination::bootstrap-4') }}
    </div>
@endsection
