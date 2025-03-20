@extends('layouts.app')

@section('content')
    <div class="container">
        <link href="{{asset('home.css')}}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">
        @can('gerer burgers')
            <h1>Bienvenue, cher Administrateur ! Comment ça va aujourd'hui ?</h1>
            <h3>Statistiques et Tendances Récentes</h3>
            <ul>
                <li>
                    <strong>Commandes actives aujourd'hui :</strong> {{ $commandesEnCours }}
                </li>
                <li>
                    <strong>Commandes complétées aujourd'hui :</strong> {{ $commandesValidees }}
                </li>
                <li>
                    <strong>Recettes générées ce jour :</strong> {{ number_format($recettesJournalières) }} CFA
                </li>
            </ul>

            <div class="row">
                <div class="col-md-6">
                    <canvas id="chartCommandesMois"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="chartProduitsCategorie"></canvas>
                </div>
            </div>
        @else
            <div class="container">
                <div class="jumbotron text-center my-4">
                    <h1>Bienvenue chez ISI BURGER</h1>
                    <p class="lead">Savourez l'excellence avec nos burgers uniques!</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Notre Histoire</h2>
                        <p>
                            ISI BURGER est un restaurant moderne et accueillant qui se spécialise dans des burgers
                            faits maison, avec des ingrédients locaux et frais. Nous combinons savoir-faire traditionnel
                            et innovations culinaires pour offrir une expérience unique à nos clients.
                        </p>
                        <h3>Nos Valeurs</h3>
                        <ul>
                            <li>Utilisation de produits frais et de saison</li>
                            <li>Préparation artisanale et sur-mesure</li>
                            <li>Accueil chaleureux et service rapide</li>
                            <li>Ambiance agréable et conviviale</li>
                        </ul>
                        <h3>Nos Créations Gourmandes</h3>
                        <p>
                            Explorez notre large gamme de burgers, des classiques incontournables aux recettes
                            innovantes, y compris des options végétariennes. Chaque burger est accompagné de frites
                            croustillantes et de sauces maison, conçues pour sublimer chaque bouchée.
                        </p>
                        <h3>Informations Clés</h3>
                        <p>
                            <strong>Adresse :</strong> Dakar Médina, Rue 39 Angle Goumba<br>
                            <strong>Téléphone :</strong> 78 27 75 79<br>
                            <strong>Horaires :</strong> Ouvert tous les jours de 11h00 à 23h00
                        </p>
                        <p>
                            Nous sommes impatients de vous recevoir pour une expérience culinaire hors du commun
                            dans un cadre décontracté et moderne !
                        </p>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection

@push('scripts')
    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Graphique des commandes mensuelles (graphique à barres)
            const ctxCommandes = document.getElementById('chartCommandesMois').getContext('2d');
            const commandesChart = new Chart(ctxCommandes, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($commandesParMois['labels'] ?? []) !!},
                    datasets: [{
                        label: 'Volume de commandes',
                        data: {!! json_encode($commandesParMois['data'] ?? []) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Graphique des produits par catégorie (graphique en secteurs)
            const ctxProduits = document.getElementById('chartProduitsCategorie').getContext('2d');
            const produitsChart = new Chart(ctxProduits, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($produitsParCategorie['labels'] ?? []) !!},
                    datasets: [{
                        label: 'Répartition des produits par catégorie',
                        data: {!! json_encode($produitsParCategorie['data'] ?? []) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
        });
    </script>
@endpush
