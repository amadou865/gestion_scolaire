@extends('layouts.app')

@section('title', 'Nouveau Niveau')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nouveau niveau
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('niveaux.store') }}" method="POST">
                        @csrf
                        
                        {{-- Nom du niveau --}}
                        <div class="mb-3">
                            <label for="nom_niveaux" class="form-label">
                                Nom du niveau <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nom_niveaux') is-invalid @enderror" 
                                   id="nom_niveaux" 
                                   name="nom_niveaux" 
                                   value="{{ old('nom_niveaux') }}" 
                                   placeholder="Ex: C1, C2, M1, M2..."
                                   required>
                            @error('nom_niveaux')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sélection de la catégorie --}}
                        <div class="mb-3">
                            <label for="categorie_niveaux_id" class="form-label">
                                Catégorie <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('categorie_niveaux_id') is-invalid @enderror" 
                                    id="categorie_niveaux_id" 
                                    name="categorie_niveaux_id" 
                                    required>
                                <option value="">Choisir une catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id_categorieNiveaux }}" 
                                        {{ old('categorie_niveaux_id') == $categorie->id_categorieNiveaux ? 'selected' : '' }}>
                                        {{ $categorie->categories_niveau }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie_niveaux_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Sélectionnez la catégorie à laquelle appartient ce niveau.
                            </small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>
                                Créer le niveau
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection