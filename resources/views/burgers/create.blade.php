@extends('layouts.app')

@section('content')
    <div class="container">
        <link href="{{asset('create.css')}}" rel="stylesheet">
        <h1>Créer un Nouveau Burger Savoureux</h1>
        <form action="{{ route('burgers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('burgers._form', ['burger' => new App\Models\Burger])
            <button type="submit" class="btn btn-success mt-3">Ajouter à la Carte</button>
        </form>
    </div>
@endsection
