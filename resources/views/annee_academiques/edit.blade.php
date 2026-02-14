{{-- 
    PAGE DE MODIFICATION D'UNE ANNÉE ACADÉMIQUE
    Affiche un formulaire pré-rempli avec les données de l'année à modifier
--}}

@extends('layouts.app')

@section('title', 'Modifier une Année Académique')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte contenant le formulaire --}}
            <div class="card">
                {{-- En-tête de la carte --}}
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Modifier l'année : {{ $anneeAcademique->annee_ac }}
                    </h4>
                </div>

                {{-- Corps de la carte avec le formulaire --}}
                <div class="card-body">
                    {{-- 
                        Formulaire de modification
                        action: route vers update() avec l'ID de l'année
                        method: POST (mais on utilise @method('PUT') pour simuler PUT)
                    --}}
                    <form action="{{ route('annee-academiques.update', $anneeAcademique) }}" method="POST">
                        @csrf {{-- Protection CSRF obligatoire --}}
                        @method('PUT') {{-- Simule une méthode PUT pour la modification --}}

                        {{-- CHAMP 1 : Année académique --}}
                        <div class="mb-3">
                            <label for="annee_ac" class="form-label">
                                Année académique <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('annee_ac') is-invalid @enderror" 
                                   id="annee_ac" 
                                   name="annee_ac" 
                                   value="{{ old('annee_ac', $anneeAcademique->annee_ac) }}" 
                                   placeholder="Ex: 2023-2024"
                                   maxlength="9"
                                   required>
                            
                            {{-- Affichage des erreurs de validation --}}
                            @error('annee_ac')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                   value="{{ old('date_debut', $anneeAcademique->date_debut ? $anneeAcademique->date_debut->format('Y-m-d') : '') }}">
                            
                            @error('date_debut')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                   value="{{ old('date_fin', $anneeAcademique->date_fin ? $anneeAcademique->date_fin->format('Y-m-d') : '') }}">
                            
                            @error('date_fin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- CHAMP 4 : Statut actif/inactif --}}
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input @error('is_active') is-invalid @enderror" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', $anneeAcademique->is_active) ? 'checked' : '' }}>
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
                        Informations sur l'année
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>ID :</strong> {{ $anneeAcademique->id_annee_ac }}
                        </li>
                        <li class="mb-2">
                            <strong>Date de création :</strong> 
                            {{ $anneeAcademique->created_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Dernière modification :</strong> 
                            {{ $anneeAcademique->updated_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Nombre de tarifs :</strong> 
                            <span class="badge bg-info">{{ $anneeAcademique->tarifs->count() }}</span>
                        </li>
                    </ul>
                    
                    {{-- ATTENTION : Message si l'année a des tarifs --}}
                    @if($anneeAcademique->tarifs->count() > 0)
                        <div class="alert alert-warning mt-2">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Attention :</strong> Cette année est utilisée par 
                            {{ $anneeAcademique->tarifs->count() }} tarif(s). La modification est possible 
                            mais soyez prudent.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection