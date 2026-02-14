{{-- 
    PAGE DÉTAILS D'UN NIVEAU
    Affiche toutes les informations d'un niveau spécifique
--}}

@extends('layouts.app')

@section('title', 'Détails du Niveau')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte principale avec les détails --}}
            <div class="card">
                {{-- En-tête --}}
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Détails du niveau : {{ $niveau->nom_niveaux }}
                    </h4>
                </div>

                <div class="card-body">
                    {{-- TABLEAU DES INFORMATIONS --}}
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px; background-color: #f8f9fa;">ID</th>
                            <td>{{ $niveau->id_niveaux }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Nom du niveau</th>
                            <td>
                                <span class="h5">{{ $niveau->nom_niveaux }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Catégorie</th>
                            <td>
                                @if($niveau->categorie)
                                    <span class="badge bg-primary p-2">
                                        {{ $niveau->categorie->categories_niveau }}
                                    </span>
                                    <small class="text-muted ms-2">
                                        (ID: {{ $niveau->categorie->id_categorieNiveaux }})
                                    </small>
                                @else
                                    <span class="badge bg-secondary">Non catégorisé</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Date de création</th>
                            <td>
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ $niveau->created_at->format('d/m/Y') }}
                                <small class="text-muted">à {{ $niveau->created_at->format('H:i') }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Dernière modification</th>
                            <td>
                                <i class="far fa-clock me-2"></i>
                                {{ $niveau->updated_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    </table>

                    {{-- SECTION DES CLASSES ASSOCIÉES --}}
                    <h5 class="mt-4 mb-3">
                        <i class="fas fa-door-open me-2"></i>
                        Classes associées à ce niveau ({{ $niveau->classes->count() }})
                    </h5>

                    @if($niveau->classes->count() > 0)
                        {{-- Tableau des classes --}}
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Nom de la classe</th>
                                        <th>Filière</th>
                                        <th>Capacité</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($niveau->classes as $classe)
                                        <tr>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $classe->code_classe }}
                                                </span>
                                            </td>
                                            <td>{{ $classe->nom_classe }}</td>
                                            <td>{{ $classe->filiere->nom_filiere ?? 'N/A' }}</td>
                                            <td>{{ $classe->capacite ?? '—' }}</td>
                                            <td>
                                                <a href="{{ route('classes.show', $classe) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Voir
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{-- Message si aucune classe --}}
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Aucune classe n'est associée à ce niveau pour le moment.
                        </div>
                    @endif

                    {{-- STATISTIQUES RAPIDES --}}
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="text-muted">Total classes</h6>
                                    <p class="display-6">{{ $niveau->classes->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="text-muted">Total filières concernées</h6>
                                    <p class="display-6">{{ $niveau->classes->groupBy('filiere_id')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- BOUTONS D'ACTION --}}
                    <div class="d-flex justify-content-between mt-4">
                        {{-- Bouton retour --}}
                        <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Retour à la liste
                        </a>
                        
                        <div>
                            {{-- Bouton modifier --}}
                            <a href="{{ route('niveaux.edit', $niveau) }}" 
                               class="btn btn-warning me-2">
                                <i class="fas fa-edit me-2"></i>
                                Modifier
                            </a>
                            
                            {{-- Bouton supprimer (avec confirmation) --}}
                            <form action="{{ route('niveaux.destroy', $niveau) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce niveau ?\n\n⚠️ Attention : {{ $niveau->classes->count() }} classe(s) sont associées à ce niveau et seront également supprimées !')">
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