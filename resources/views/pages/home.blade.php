@extends('layouts.main')

@section('title', 'Accueil')

@section('content')
    <div class="container text-center mt-5">
        <h1 class="fw-bold">Bienvenue sur LaraLink</h1>
        <p class="lead text-muted mt-3">
            LaraLink est un service de raccourcissement d'URL simple et efficace.<br>
            Créez des liens courts, partagez-les facilement et suivez leur activité.
        </p>

        @guest
            <div class="mt-4">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">S'inscrire</a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Se connecter</a>
            </div>
        @else
            <div class="mt-4">
                <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">Accéder au Dashboard</a>
            </div>
        @endguest
    </div>
@endsection
