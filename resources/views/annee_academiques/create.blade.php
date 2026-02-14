{{-- 
    PAGE DE CRÉATION D'UNE ANNÉE ACADÉMIQUE
    Affiche un formulaire pour créer une nouvelle année académique
--}}

@extends('layouts.app')

@section('title', 'Nouvelle Année Académique')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte contenant le formulaire --}}
            <div class="card">
                {{-- En-tête de la carte --}}
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nouvelle année académique
                    </h4>
                </div>

                {{-- Corps de la carte avec le formulaire --}}
                <div class="card-body">
                    {{-- 
                        Formulaire de création
                        action: route vers store()
                        method: POST
                    --}}
                    <form action="{{ route('annee-academiques.store') }}" method="POST">
                        @csrf {{-- Protection CSRF obligatoire --}}

                        {{-- CHAMP 1 : Année académique (ex: 2023-2024) --}}
                        <div class="mb-3">
                            <label for="annee_ac" class="form-label">
                                Année académique <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('annee_ac') is-invalid @enderror" 
                                   id="annee_ac" 
                                   name="annee_ac" 
                                   value="{{ old('annee_ac') }}" 
                                   placeholder="Ex: 2023-2024"
                                   maxlength="9"
                                   required>
                            
                            {{-- Affichage des erreurs de validation pour ce champ --}}
                            @error('annee_ac')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <small class="form-text text-muted">
                                Format: AAAA-AAAA (ex: 2023-2024)
                            </small>
                        </div>

                        {{-- CHAMP 2 : Date de début --}}
                        <div class="mb-3">
                            <label for="date_debut" class="form-label">
                                Date de début
                            </label>
                            <input type="date" 
                                   class="form-control @error('date_debut') is-invalid @enderror" 
                                   id="date_debut" 
                                   name="date_debut" 
                                   value="{{ old('date_debut') }}">
                            
                            @error('date_debut')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <small class="form-text text-muted">
                                Date de début de l'année académique (optionnelle)
                            </small>
                        </div>

                        {{-- CHAMP 3 : Date de fin --}}
                        <div class="mb-3">
                            <label for="date_fin" class="form-label">
                                Date de fin
                            </label>
                            <input type="date" 
                                   class="form-control @error('date_fin') is-invalid @enderror" 
                                   id="date_fin" 
                                   name="date_fin" 
                                   value="{{ old('date_fin') }}">
                            
                            @error('date_fin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <small class="form-text text-muted">
                                Date de fin de l'année académique (doit être après la date de début)
                            </small>
                        </div>

                        {{-- CHAMP 4 : Statut actif/inactif --}}
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input @error('is_active') is-invalid @enderror" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Année active
                                </label>
                                @error('is_active')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Si cochée, cette année sera l'année active (une seule année peut être active)
                            </small>
                        </div>

                        {{-- ZONE DES BOUTONS D'ACTION --}}
                        <div class="d-flex justify-content-between">
                            {{-- Bouton Annuler : retour à la liste --}}
                            <a href="{{ route('annee-academiques.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Annuler
                            </a>
                            
                            {{-- Bouton de soumission --}}
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>
                                Créer l'année
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection