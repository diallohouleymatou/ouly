@extends('layouts.app')

@section('content')
    <div class="container">
        <link href="{{asset('showc.css')}}" rel="stylesheet">
        <h1>Commande Détails</h1>

        <p><strong>Statut:</strong> {{ $commande->statut }}</p>
        <p><strong>Total:</strong> {{ number_format($commande->total, 2) }} FCFA</p>

        <h3>Articles dans la commande :</h3>
        <ul>
            @foreach ($commande->burgers as $burger)
                <li>{{ $burger->nom }} - {{ $burger->pivot->quantite }} x {{ number_format($burger->prix, 2) }}FCFA
                </li>
            @endforeach
        </ul>

        @if ($commande->statut == 'en attente')
            <form action="{{ route('commande.validate', $commande) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Preparer Commande</button>
            </form>
        @elseif($commande->statut == 'en preparation')
            <form action="{{ route('commande.finalize', $commande) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Valider le paiement final</button>
            </form>
        @else
            <p>Cette commande a déjà été validée ou payee.</p>
        @endif
    </div>

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif
@endsection
