<form action="{{ route('panier.ajouter') }}" method="POST">
    <link href="{{asset('ajoutp.css')}}" rel="stylesheet">
    @csrf
    <input type="hidden" name="burger_id" value="{{ $burger->id }}">
    @cannot('gerer burgers')
        <button type="submit" class="btn btn-success">Ajouter au Panier</button>
    @endcannot
</form>
