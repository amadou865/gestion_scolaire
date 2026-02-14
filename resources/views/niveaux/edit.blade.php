{{-- 
    PAGE DE MODIFICATION D'UN NIVEAU
    Affiche un formulaire pré-rempli avec les données du niveau à modifier
--}}

@extends('layouts.app')

@section('title', 'Modifier un Niveau')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte contenant le formulaire --}}
            <div class="card">
                {{-- En-tête de la carte --}}
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Modifier le niveau : {{ $niveau->nom_niveaux }}
                    </h4>
                </div>

                {{-- Corps de la carte avec le formulaire --}}
                <div class="card-body">
                    {{-- 
                        Formulaire de modification
                        action: route vers update() avec l'ID du niveau
                        method: POST (mais on utilise @method('PUT') pour simuler PUT)
                    --}}
                    <form action="{{ route('niveaux.update', $niveau) }}" method="POST">
                        @csrf {{-- Protection CSRF obligatoire --}}
                        @method('PUT') {{-- Simule une méthode PUT pour la modification --}}
                        
                        {{-- CHAMP 1 : Nom du niveau --}}
                        <div class="mb-3">
                            <label for="nom_niveaux" class="form-label">
                                Nom du niveau <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nom_niveaux') is-invalid @enderror" 
                                   id="nom_niveaux" 
                                   name="nom_niveaux" 
                                   value="{{ old('nom_niveaux', $niveau->nom_niveaux) }}" 
                                   placeholder="Ex: C1, C2, M1, M2..."
                                   required>
                            
                            {{-- Affichage des erreurs de validation pour ce champ --}}
                            @error('nom_niveaux')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <small class="form-text text-muted">
                                Le nom du niveau (ex: C1 pour première année)
                            </small>
                        </div>

                        {{-- CHAMP 2 : Sélection de la catégorie (menu déroulant) --}}
                        <div class="mb-3">
                            <label for="categorie_niveaux_id" class="form-label">
                                Catégorie <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('categorie_niveaux_id') is-invalid @enderror" 
                                    id="categorie_niveaux_id" 
                                    name="categorie_niveaux_id" 
                                    required>
                                <option value="">-- Choisir une catégorie --</option>
                                
                                {{-- Boucle sur toutes les catégories disponibles --}}
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id_categorieNiveaux }}" 
                                        {{-- Sélectionne automatiquement la catégorie actuelle --}}
                                        {{ old('categorie_niveaux_id', $niveau->categorie_niveaux_id) == $categorie->id_categorieNiveaux ? 'selected' : '' }}>
                                        {{ $categorie->categories_niveau }}
                                    </option>
                                @endforeach
                            </select>
                            
                            {{-- Affichage des erreurs de validation --}}
                            @error('categorie_niveaux_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <small class="form-text text-muted">
                                Choisissez la catégorie à laquelle appartient ce niveau
                            </small>
                        </div>

                        {{-- ZONE DES BOUTONS D'ACTION --}}
                        <div class="d-flex justify-content-between">
                            {{-- Bouton Annuler : retour à la liste --}}
                            <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Annuler
                            </a>
                            
                            {{-- Bouton de soumission --}}
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- CARTE D'INFORMATION SUPPLÉMENTAIRE --}}
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informations sur le niveau
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>ID :</strong> {{ $niveau->id_niveaux }}
                        </li>
                        <li class="mb-2">
                            <strong>Date de création :</strong> 
                            {{ $niveau->created_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Dernière modification :</strong> 
                            {{ $niveau->updated_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Nombre de classes :</strong> 
                            <span class="badge bg-info">{{ $niveau->classes->count() }}</span>
                        </li>
                    </ul>
                    
                    {{-- ATTENTION : Message si le niveau a des classes --}}
                    @if($niveau->classes->count() > 0)
                        <div class="alert alert-warning mt-2">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Attention :</strong> Ce niveau est utilisé par 
                            {{ $niveau->classes->count() }} classe(s). La modification est possible 
                            mais soyez prudent.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection