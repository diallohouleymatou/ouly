<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - ISI Burger - Commande #{{ $commande->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
            color: #4a4a4a;
            background-color: #fafafa;
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 120px;
            height: auto;
        }

        .company-details h2 {
            color: #f7a7a1;
            margin-bottom: 5px;
            font-size: 26px;
        }

        .company-details p {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }

        .invoice-title {
            text-align: center;
            font-size: 28px;
            color: #f7a7a1;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .client-details,
        .invoice-details {
            margin-bottom: 25px;
        }

        .invoice-id {
            font-size: 16px;
            color: #f7a7a1;
            font-weight: bold;
        }

        .client-details p,
        .invoice-details p {
            font-size: 14px;
            margin: 5px 0;
            color: #4a4a4a;
        }

        .client-details strong,
        .invoice-details strong {
            font-weight: bold;
            color: #f7a7a1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th {
            background-color: #f7a7a1;
            color: white;
            padding: 12px;
            font-size: 14px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
            color: #4a4a4a;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total-section {
            text-align: right;
            margin-top: 20px;
        }

        .total-line {
            font-size: 16px;
            font-weight: bold;
            color: #4a4a4a;
            margin-bottom: 10px;
        }

        .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #f7a7a1;
            border-top: 2px solid #f7a7a1;
            padding-top: 10px;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .payment-info {
            background-color: #fdf4f4;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            font-size: 14px;
        }

        .payment-info h3 {
            color: #f7a7a1;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .notes {
            font-style: italic;
            font-size: 14px;
            margin-top: 30px;
            color: #4a4a4a;
        }

        .notes p {
            margin-bottom: 5px;
        }

        .barcode {
            text-align: center;
            margin: 30px 0;
        }

        .status-paid {
            color: #28a745;
            font-weight: bold;
        }

        .status-pending {
            color: #ffc107;
            font-weight: bold;
        }

        .status-cancelled {
            color: #dc3545;
            font-weight: bold;
        }

    </style>
</head>

<body>

<div class="header">
    <img class="logo"
         src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/images/logo.png'))) }}"
         alt="Logo ISI Burger">
    <div class="company-details">
        <h2>ISI Burger</h2>
        <p>12 Avenue de la Liberté, Dakar, Sénégal<br>
            Tél: +221 781706184<br>
            Email: contact@isiburger.sn<br>
            Site web: www.isiburger.sn</p>
    </div>
</div>

<h1 class="invoice-title">FACTURE EN FEU 🔥</h1>

<div class="client-details">
    <h3>Oups! Vous êtes gourmand(e) 😋</h3>
    <p><strong>Nom:</strong> {{ $commande->user->name }}<br>
        <strong>Numéro de téléphone:</strong> {{ $commande->user->telephone }}<br>
        <strong>Email:</strong> {{ $commande->user->email }}<br>
        <strong>Client(e) fidèle depuis:</strong> {{ $commande->user->created_at->format('d/m/Y') }}
    </p>
</div>

<div class="invoice-details">
    <h3>Les Détails de la Commande</h3>
    <p><span
            class="invoice-id">Commande #{{ $commande->id }} - Facture #{{ $commande->reference_facture ?? 'F-' . str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</span><br>
        <strong>Date de la commande:</strong> {{ $commande->created_at->format('d/m/Y à H:i') }}<br>
        <strong>Mode de paiement:</strong> {{ $commande->mode_paiement }}<br>
        <strong>Statut de la commande:</strong>
        @if ($commande->statut == 'Payée')
            <span class="status-paid">{{ $commande->statut }}</span>
        @elseif($commande->statut == 'En attente')
            <span class="status-pending">{{ $commande->statut }}</span>
        @elseif($commande->statut == 'Annulée')
            <span class="status-cancelled">{{ $commande->statut }}</span>
        @else
            {{ $commande->statut }}
        @endif
    </p>
</div>

<table>
    <thead>
    <tr>
        <th>Produit 🍔</th>
        <th>Description 📜</th>
        <th>Quantité 🍽️</th>
        <th>Prix 💰</th>
        <th>Sous-total 💸</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($commande->burgers as $produit)
        <tr>
            <td>{{ $produit->nom }}</td>
            <td>{{ $produit->description }}</td>
            <td>{{ $produit->pivot->quantite }}</td>
            <td>{{ number_format($produit->prix, 0, '.', ' ') }} CFA</td>
            <td>{{ number_format($produit->prix * $produit->pivot->quantite, 0, '.', ' ') }} CFA</td>
        </tr>
    @endforeach

    @if ($commande->burgers->count() > 0)
        @foreach ($commande->burgers as $supplement)
            <tr>
                <td>Supplément: {{ $supplement->nom }}</td>
                <td>{{ $supplement->description }}</td>
                <td>{{ $supplement->pivot->quantite }}</td>
                <td>{{ number_format($supplement->prix, 0, '.', ' ') }} CFA</td>
                <td>{{ number_format($supplement->prix * $supplement->pivot->quantite, 0, '.', ' ') }} CFA</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<div class="total-section">
    <p class="total-line"><strong>Sous-total 🍔:</strong> {{ number_format($commande->sous_total, 0, '.', ' ') }} CFA</p>
    <p class="total-line"><strong>Frais de livraison
            🚚:</strong> {{ number_format($commande->frais_livraison, 0, '.', ' ') }} CFA</p>
    @if ($commande->code_promo)
        <p class="total-line"><strong>Promo ({{ $commande->code_promo }}):</strong>
            -{{ number_format($commande->montant_reduction, 0, '.', ' ') }} CFA</p>
    @endif
    <p class="total-line"><strong>TVA (18% 💸):</strong> {{ number_format($commande->montant_tva, 0, '.', ' ') }} CFA</p>
    <p class="grand-total"><strong>TOTAL 🤑:</strong> {{ number_format($commande->total, 0, '.', ' ') }} CFA</p>
</div>

<div class="payment-info">
    <h3>Comment régler tout ça ? 💸</h3>
    <p>Faites votre paiement en toute simplicité via les options ci-dessous :</p>
    <p><strong>Coordonnées bancaires:</strong><br>
        Banque: CBAO Groupe Attijariwafa Bank<br>
        IBAN: SN01 1234 5678 9012 3456 7890<br>
        BIC/SWIFT: CBAOSNDA</p>

    <p><strong>Mobile Money (Orange Money & Wave):</strong><br>
        Orange Money: +221 78 277 55 79<br>
        Wave: +221 78 170 61 84</p>
</div>

<div class="notes">
    <p>Merci de votre commande ! 🙌 On adore vous servir !</p>
    <p>Cette facture est valable pendant 14 jours. Si vous avez des questions ou des préoccupations, contactez notre
        équipe au 📞 <a href="tel:+221781706184">+221 78 170 61 84</a> ou envoyez-nous un email à <a href="mailto:facturation@isiburger
