@extends('layouts.error')
@section('content')
    <div class="main-wrapper">
        <div class="error-box">
            <h1>404</h1>
            <h3 class="h2 mb-3"><i class="fas fa-exclamation-triangle"></i>Oops! Page non trouvée!</h3>
            <p class="h4 font-weight-normal">La page que vous avez demandée n'a pas été trouvée.</p>
            <a href="{{route('accueil')}}" class="btn btn-primary">Retour à la page d'accueil</a>
        </div>
    </div>
@endsection
