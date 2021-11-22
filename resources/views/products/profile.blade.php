@extends('layouts.app')

@section('content')
    <div>
        <h1>{{ $user->name }}</h1>
        <h2>{{ $user->email }}</h2>

        <p>Moje objednavky:</p>
        @foreach($orders as $order)
            <p>Datum: <span>{{ $order->created_at }}</span></p>
            <p>Cena: <span>{{ $order->totalPrice }} eur</span></p>

        @endforeach
    </div>
@endsection
