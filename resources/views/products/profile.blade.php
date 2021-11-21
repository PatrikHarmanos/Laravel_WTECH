@extends('layouts.app')

@section('content')
    <div>
        <h1>{{ $user->name }}</h1>
        <h2>{{ $user->email }}</h2>

        <p>Moje objednavky:</p>
    </div>
@endsection
