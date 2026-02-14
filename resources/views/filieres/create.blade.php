@extends('layouts.app')

@section('title', 'Nouvelle Filière')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nouvelle filière
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('filieres.store') }}" method="POST">
                        @csrf
                        
                        {{-- Code de la filière --}}
                        <div class="mb-3">
                            <label for="code" class="form-label">
                                Code <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('code') is-invalid @enderror" 
                                   id="code" 
                                   name="code" 
                                   value="{{ old('code') }}" 
                                   placeholder="Ex: INFO, GESTION, MECA..."
                                   required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Code unique pour identifier la filière (ex: INFO pour Informatique)
                            </small>
                        </div>

                        {{-- Nom de la filière --}}
                        <div class="mb-3">
                            <label for="nom_filiere" class="form-label">
                                Nom de la filière <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nom_filiere') is-invalid @enderror" 
                                   id="nom_filiere" 
                                   name="nom_filiere" 
                                   value="{{ old('nom_filiere') }}" 
                                   placeholder="Ex: Informatique, Gestion, Mécanique..."
                                   required>
                            @error('nom_filiere')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4"
                                      placeholder="Description de la filière...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('filieres.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-save me-2"></i>
                                Créer la filière
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection