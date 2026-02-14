{{-- 
    PAGE DE MODIFICATION D'UNE FILIÈRE
    Affiche un formulaire pré-rempli avec les données de la filière à modifier
--}}

@extends('layouts.app')

@section('title', 'Modifier une Filière')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte contenant le formulaire --}}
            <div class="card">
                {{-- En-tête de la carte --}}
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Modifier la filière : {{ $filiere->nom_filiere }}
                    </h4>
                </div>

                {{-- Corps de la carte avec le formulaire --}}
                <div class="card-body">
                    {{-- 
                        Formulaire de modification
                        action: route vers update() avec l'ID de la filière
                        method: POST (mais on utilise @method('PUT') pour simuler PUT)
                    --}}
                    <form action="{{ route('filieres.update', $filiere) }}" method="POST">
                        @csrf {{-- Protection CSRF obligatoire --}}
                        @method('PUT') {{-- Simule une méthode PUT pour la modification --}}

                        {{-- CHAMP 1 : Code de la filière --}}
                        <div class="mb-3">
                            <label for="code" class="form-label">
                                Code <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('code') is-invalid @enderror" 
                                   id="code" 
                                   name="code" 
                                   value="{{ old('code', $filiere->code) }}" 
                                   maxlength="50"
                                   required>
                            
                            {{-- Affichage des erreurs de validation --}}
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <small class="form-text text-muted">
                                Code unique (doit être différent des autres filières)
                            </small>
                        </div>

                        {{-- CHAMP 2 : Nom de la filière --}}
                        <div class="mb-3">
                            <label for="nom_filiere" class="form-label">
                                Nom de la filière <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nom_filiere') is-invalid @enderror" 
                                   id="nom_filiere" 
                                   name="nom_filiere" 
                                   value="{{ old('nom_filiere', $filiere->nom_filiere) }}" 
                                   maxlength="255"
                                   required>
                            
                            @error('nom_filiere')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- CHAMP 3 : Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4">{{ old('description', $filiere->description) }}</textarea>
                            
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- ZONE DES BOUTONS D'ACTION --}}
                        <div class="d-flex justify-content-between">
                            {{-- Bouton Annuler : retour à la liste --}}
                            <a href="{{ route('filieres.index') }}" class="btn btn-secondary">
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
                        Informations sur la filière
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>ID :</strong> {{ $filiere->id }}
                        </li>
                        <li class="mb-2">
                            <strong>Date de création :</strong> 
                            {{ $filiere->created_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Dernière modification :</strong> 
                            {{ $filiere->updated_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Nombre de classes :</strong> 
                            <span class="badge bg-info">{{ $filiere->classes->count() }}</span>
                        </li>
                    </ul>
                    
                    {{-- ATTENTION : Message si la filière a des classes --}}
                    @if($filiere->classes->count() > 0)
                        <div class="alert alert-warning mt-2">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Attention :</strong> Cette filière est utilisée par 
                            {{ $filiere->classes->count() }} classe(s). La modification est possible 
                            mais soyez prudent.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection