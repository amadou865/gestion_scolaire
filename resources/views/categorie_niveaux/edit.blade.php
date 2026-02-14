{{-- 
    PAGE DE MODIFICATION D'UNE CATÉGORIE
    Affiche un formulaire pré-rempli pour modifier une catégorie
--}}

@extends('layouts.app')

@section('title', 'Modifier une Catégorie')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Modifier la catégorie
                    </h4>
                </div>
                <div class="card-body">
                    {{-- Formulaire de modification --}}
                    <form action="{{ route('categorie-niveaux.update', $categorieNiveau) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Indique que c'est une modification --}}
                        
                        {{-- Champ Nom de la catégorie --}}
                        <div class="mb-3">
                            <label for="categories_niveau" class="form-label">
                                Nom de la catégorie <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('categories_niveau') is-invalid @enderror" 
                                   id="categories_niveau" 
                                   name="categories_niveau" 
                                   value="{{ old('categories_niveau', $categorieNiveau->categories_niveau) }}" 
                                   required>
                            
                            @error('categories_niveau')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Champ Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4">{{ old('description', $categorieNiveau->description) }}</textarea>
                            
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Boutons d'action --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categorie-niveaux.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection