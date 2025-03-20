@extends('layouts.app')

@section('content')
    <div class="container">
        <link href="{{asset('edit.css')}}" rel="stylesheet">
        <h1>Mettre à Jour un Burger</h1>
        <form action="{{ route('burgers.update', $burger) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('burgers._form', ['burger' => $burger])
            <button type="submit" class="btn btn-success mt-3">Mettre à jour le Burger</button>
        </form>
    </div>
@endsection
