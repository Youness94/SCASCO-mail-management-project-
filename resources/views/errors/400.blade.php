@extends('layouts.app')  <!-- Assuming you have a layout file -->
@section('content')
    <div class="main-wrapper">
        <div class="error-box">
            <h1>400</h1>
            <h3 class="h2 mb-3"><i class="fas fa-exclamation-triangle"></i> Mauvaise demande</h3>
            <p class="h4 font-weight-normal">La page que vous avez demandée est introuvable.</p>
            <a href="{{ route('accueil') }}" class="btn btn-primary">Retour à la page d'accueil</a>
        </div>
    </div>
@endsection