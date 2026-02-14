{{-- 
    PAGE DE CRÉATION D'UNE CATÉGORIE
    Affiche un formulaire pour créer une nouvelle catégorie
--}}

@extends('layouts.app')

@section('title', 'Nouvelle Catégorie')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nouvelle catégorie de niveau
                    </h4>
                </div>
                <div class="card-body">
                    {{-- Formulaire d'ajout --}}
                    <form action="{{ route('categorie-niveaux.store') }}" method="POST">
                        @csrf {{-- Protection contre les attaques CSRF --}}
                        
                        {{-- Champ Nom de la catégorie --}}
                        <div class="mb-3">
                            <label for="categories_niveau" class="form-label">
                                Nom de la catégorie <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('categories_niveau') is-invalid @enderror" 
                                   id="categories_niveau" 
                                   name="categories_niveau" 
                                   value="{{ old('categories_niveau') }}" 
                                   placeholder="Ex: Premier cycle, Deuxième cycle..."
                                   required>
                            
                            {{-- Affichage des erreurs de validation --}}
                            @error('categories_niveau')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Le nom de la catégorie doit être unique et descriptif.
                            </small>
                        </div>

                        {{-- Champ Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4"
                                      placeholder="Description de la catégorie...">{{ old('description') }}</textarea>
                            
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Optionnel : décrivez brièvement cette catégorie.
                            </small>
                        </div>

                        {{-- Boutons d'action --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categorie-niveaux.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Créer la catégorie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection