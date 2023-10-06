@extends('layouts.error')
@section('content')
    <div class="main-wrapper">
        <div class="error-box">
            <h1>500</h1>
            <h3 class="h2 mb-3"><i class="fas fa-exclamation-triangle"></i> Erreur interne du serveur</h3>
            <p class="h4 font-weight-normal">Vous n'êtes pas autorisé à afficher cette ressource</p>
            <a href="{{route('accueil')}}" class="btn btn-primary">Retour à la page d'accueil</a>
        </div>
    </div>
@endsection
