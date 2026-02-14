{{-- 
    PAGE DÉTAILS D'UNE CATÉGORIE
    Affiche toutes les informations d'une catégorie spécifique
--}}

@extends('layouts.app')

@section('title', 'Détails de la Catégorie')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Détails de la catégorie
                    </h4>
                </div>
                <div class="card-body">
                    {{-- Tableau des informations --}}
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">ID</th>
                            <td>{{ $categorieNiveau->id_categorieNiveaux }}</td>
                        </tr>
                        <tr>
                            <th>Nom de la catégorie</th>
                            <td>{{ $categorieNiveau->categories_niveau }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $categorieNiveau->description ?? 'Aucune description' }}</td>
                        </tr>
                        <tr>
                            <th>Date de création</th>
                            <td>{{ $categorieNiveau->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Dernière modification</th>
                            <td>{{ $categorieNiveau->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>

                    {{-- Section des niveaux associés --}}
                    <h5 class="mt-4">
                        <i class="fas fa-level-up-alt me-2"></i>
                        Niveaux associés ({{ $categorieNiveau->niveaux->count() }})
                    </h5>
                    
                    @if($categorieNiveau->niveaux->count() > 0)
                        <div class="list-group mb-3">
                            @foreach($categorieNiveau->niveaux as $niveau)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $niveau->nom_niveaux }}
                                    <a href="{{ route('niveaux.show', $niveau) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Aucun niveau associé à cette catégorie.
                        </div>
                    @endif

                    {{-- Boutons d'action --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('categorie-niveaux.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Retour à la liste
                        </a>
                        <div>
                            <a href="{{ route('categorie-niveaux.edit', $categorieNiveau) }}" 
                               class="btn btn-warning me-2">
                                <i class="fas fa-edit me-2"></i>
                                Modifier
                            </a>
                            <form action="{{ route('categorie-niveaux.destroy', $categorieNiveau) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                    <i class="fas fa-trash me-2"></i>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection