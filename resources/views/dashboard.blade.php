{{-- 
    PAGE D'ACCUEIL DE L'APPLICATION
    Elle étend le layout principal
--}}

@extends('layouts.app')

{{-- Titre de la page --}}
@section('title', 'Tableau de Bord')

{{-- Contenu de la page --}}
@section('content')
    {{-- En-tête --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="display-4">
                <i class="fas fa-chart-line text-primary me-3"></i>
                Tableau de Bord
            </h1>
            <p class="lead text-muted">
                Bienvenue dans votre application de gestion scolaire. 
                Voici un aperçu rapide de vos données.
            </p>
        </div>
    </div>

    {{-- 
        CARTES STATISTIQUES
        Chaque carte montre le nombre d'éléments dans chaque table
    --}}
    <div class="row">
        {{-- Carte Catégories --}}
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Catégories</h5>
                            <p class="card-text display-4">{{ \App\Models\CategorieNiveau::count() }}</p>
                        </div>
                        <i class="fas fa-tags fa-4x opacity-50"></i>
                    </div>
                    <a href="{{ route('categorie-niveaux.index') }}" class="btn btn-light mt-3">
                        Voir détails <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Carte Niveaux --}}
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Niveaux</h5>
                            <p class="card-text display-4">{{ \App\Models\Niveau::count() }}</p>
                        </div>
                        <i class="fas fa-level-up-alt fa-4x opacity-50"></i>
                    </div>
                    <a href="{{ route('niveaux.index') }}" class="btn btn-light mt-3">
                        Voir détails <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Carte Filières --}}
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Filières</h5>
                            <p class="card-text display-4">{{ \App\Models\Filiere::count() }}</p>
                        </div>
                        <i class="fas fa-graduation-cap fa-4x opacity-50"></i>
                    </div>
                    <a href="{{ route('filieres.index') }}" class="btn btn-light mt-3">
                        Voir détails <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Carte Années --}}
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Années Académiques</h5>
                            <p class="card-text display-4">{{ \App\Models\AnneeAcademique::count() }}</p>
                        </div>
                        <i class="fas fa-calendar-alt fa-4x opacity-50"></i>
                    </div>
                    <a href="{{ route('annee-academiques.index') }}" class="btn btn-light mt-3">
                        Voir détails <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Carte Classes --}}
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Classes</h5>
                            <p class="card-text display-4">{{ \App\Models\Classe::count() }}</p>
                        </div>
                        <i class="fas fa-door-open fa-4x opacity-50"></i>
                    </div>
                    <a href="{{ route('classes.index') }}" class="btn btn-light mt-3">
                        Voir détails <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Carte Tarifs --}}
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-secondary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Tarifs</h5>
                            <p class="card-text display-4">{{ \App\Models\Tarif::count() }}</p>
                        </div>
                        <i class="fas fa-money-bill-wave fa-4x opacity-50"></i>
                    </div>
                    <a href="{{ route('tarifs.index') }}" class="btn btn-light mt-3">
                        Voir détails <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ACTIONS RAPIDES --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Actions rapides
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('categorie-niveaux.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus-circle me-2"></i>
                                Nouvelle catégorie
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('niveaux.create') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-plus-circle me-2"></i>
                                Nouveau niveau
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('filieres.create') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-plus-circle me-2"></i>
                                Nouvelle filière
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('annee-academiques.create') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-plus-circle me-2"></i>
                                Nouvelle année
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('classes.create') }}" class="btn btn-outline-danger w-100">
                                <i class="fas fa-plus-circle me-2"></i>
                                Nouvelle classe
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('tarifs.create') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-plus-circle me-2"></i>
                                Nouveau tarif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection