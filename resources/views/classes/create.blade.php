{{-- 
    PAGE DE CRÉATION D'UNE CLASSE
    Affiche un formulaire pour créer une nouvelle classe
--}}

@extends('layouts.app')

@section('title', 'Nouvelle Classe')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte contenant le formulaire --}}
            <div class="card">
                {{-- En-tête de la carte --}}
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nouvelle classe
                    </h4>
                </div>

                {{-- Corps de la carte avec le formulaire --}}
                <div class="card-body">
                    {{-- 
                        Formulaire de création
                        action: route vers store()
                        method: POST
                    --}}
                    <form action="{{ route('classes.store') }}" method="POST">
                        @csrf {{-- Protection CSRF obligatoire --}}

                        {{-- CHAMP 1 : Code de la classe --}}
                        <div class="mb-3">
                            <label for="code_classe" class="form-label">
                                Code de la classe <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('code_classe') is-invalid @enderror" 
                                   id="code_classe" 
                                   name="code_classe" 
                                   value="{{ old('code_classe') }}" 
                                   placeholder="Ex: INFO-C1, GEST-M2, MECA-L3..."
                                   maxlength="50"
                                   required>
                            
                            @error('code_classe')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Code unique pour identifier la classe (ex: INFO-C1)
                            </small>
                        </div>

                        {{-- CHAMP 2 : Nom de la classe --}}
                        <div class="mb-3">
                            <label for="nom_classe" class="form-label">
                                Nom de la classe <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nom_classe') is-invalid @enderror" 
                                   id="nom_classe" 
                                   name="nom_classe" 
                                   value="{{ old('nom_classe') }}" 
                                   placeholder="Ex: C1 Informatique, Master 2 Gestion..."
                                   maxlength="255"
                                   required>
                            
                            @error('nom_classe')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- CHAMP 3 : Capacité --}}
                        <div class="mb-3">
                            <label for="capacite" class="form-label">
                                Capacité d'accueil
                            </label>
                            <input type="number" 
                                   class="form-control @error('capacite') is-invalid @enderror" 
                                   id="capacite" 
                                   name="capacite" 
                                   value="{{ old('capacite') }}" 
                                   placeholder="Ex: 30, 45, 60..."
                                   min="1" 
                                   max="100">
                            
                            @error('capacite')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Nombre maximum d'élèves (optionnel, entre 1 et 100)
                            </small>
                        </div>

                        {{-- CHAMP 4 : Sélection de la filière --}}
                        <div class="mb-3">
                            <label for="filiere_id" class="form-label">
                                Filière <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('filiere_id') is-invalid @enderror" 
                                    id="filiere_id" 
                                    name="filiere_id" 
                                    required>
                                <option value="">-- Choisir une filière --</option>
                                
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" 
                                        {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->code }} - {{ $filiere->nom_filiere }}
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('filiere_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- CHAMP 5 : Sélection du niveau --}}
                        <div class="mb-3">
                            <label for="niveaux_id" class="form-label">
                                Niveau <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('niveaux_id') is-invalid @enderror" 
                                    id="niveaux_id" 
                                    name="niveaux_id" 
                                    required>
                                <option value="">-- Choisir un niveau --</option>
                                
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id_niveaux }}" 
                                        {{ old('niveaux_id') == $niveau->id_niveaux ? 'selected' : '' }}>
                                        {{ $niveau->nom_niveaux }} 
                                        ({{ $niveau->categorie->categories_niveau ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('niveaux_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- RÉCAPITULATIF --}}
                        <div class="alert alert-info" id="recap">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Récapitulatif :</strong>
                            <span id="recapTexte">Sélectionnez une filière et un niveau</span>
                        </div>

                        {{-- ZONE DES BOUTONS D'ACTION --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-save me-2"></i>
                                Créer la classe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT POUR LE RÉCAPITULATIF DYNAMIQUE --}}
    @push('scripts')
    <script>
        // Récupérer les éléments du DOM
        const filiereSelect = document.getElementById('filiere_id');
        const niveauSelect = document.getElementById('niveaux_id');
        const recapTexte = document.getElementById('recapTexte');

        // Fonction pour mettre à jour le récapitulatif
        function updateRecap() {
            let filiereTexte = filiereSelect.options[filiereSelect.selectedIndex]?.text || 'Aucune filière';
            let niveauTexte = niveauSelect.options[niveauSelect.selectedIndex]?.text || 'Aucun niveau';
            
            // Enlever la valeur "option vide" si sélectionnée
            if (filiereSelect.value === '') filiereTexte = 'Aucune filière';
            if (niveauSelect.value === '') niveauTexte = 'Aucun niveau';
            
            recapTexte.textContent = `${filiereTexte} - ${niveauTexte}`;
        }

        // Écouter les changements
        filiereSelect.addEventListener('change', updateRecap);
        niveauSelect.addEventListener('change', updateRecap);
        
        // Mise à jour initiale
        updateRecap();
    </script>
    @endpush
@endsection