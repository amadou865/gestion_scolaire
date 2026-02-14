{{-- 
    PAGE DE MODIFICATION D'UNE CLASSE
    Affiche un formulaire pré-rempli avec les données de la classe à modifier
--}}

@extends('layouts.app')

@section('title', 'Modifier une Classe')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte contenant le formulaire --}}
            <div class="card">
                {{-- En-tête de la carte --}}
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Modifier la classe : {{ $classe->nom_classe }}
                    </h4>
                </div>

                {{-- Corps de la carte avec le formulaire --}}
                <div class="card-body">
                    {{-- 
                        Formulaire de modification
                        action: route vers update() avec l'ID de la classe
                        method: POST (mais on utilise @method('PUT') pour simuler PUT)
                    --}}
                    <form action="{{ route('classes.update', $classe) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- CHAMP 1 : Code de la classe --}}
                        <div class="mb-3">
                            <label for="code_classe" class="form-label">
                                Code de la classe <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('code_classe') is-invalid @enderror" 
                                   id="code_classe" 
                                   name="code_classe" 
                                   value="{{ old('code_classe', $classe->code_classe) }}" 
                                   maxlength="50"
                                   required>
                            
                            @error('code_classe')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                   value="{{ old('nom_classe', $classe->nom_classe) }}" 
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
                                   value="{{ old('capacite', $classe->capacite) }}" 
                                   min="1" 
                                   max="100">
                            
                            @error('capacite')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                        {{ old('filiere_id', $classe->filiere_id) == $filiere->id ? 'selected' : '' }}>
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
                                        {{ old('niveaux_id', $classe->niveaux_id) == $niveau->id_niveaux ? 'selected' : '' }}>
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
                            <span id="recapTexte"></span>
                        </div>

                        {{-- ZONE DES BOUTONS D'ACTION --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('classes.index') }}" class="btn btn-secondary">
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

            {{-- CARTE D'INFORMATION SUPPLÉMENTAIRE --}}
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informations sur la classe
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>ID :</strong> {{ $classe->id_classe }}
                        </li>
                        <li class="mb-2">
                            <strong>Date de création :</strong> 
                            {{ $classe->created_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Dernière modification :</strong> 
                            {{ $classe->updated_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Nombre de tarifs :</strong> 
                            <span class="badge bg-info">{{ $classe->tarifs->count() }}</span>
                        </li>
                    </ul>
                    
                    @if($classe->tarifs->count() > 0)
                        <div class="alert alert-warning mt-2">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Attention :</strong> Cette classe a {{ $classe->tarifs->count() }} tarif(s) associé(s).
                            La modification est possible mais soyez prudent.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT POUR LE RÉCAPITULATIF DYNAMIQUE --}}
    @push('scripts')
    <script>
        const filiereSelect = document.getElementById('filiere_id');
        const niveauSelect = document.getElementById('niveaux_id');
        const recapTexte = document.getElementById('recapTexte');

        function updateRecap() {
            let filiereTexte = filiereSelect.options[filiereSelect.selectedIndex]?.text || 'Aucune filière';
            let niveauTexte = niveauSelect.options[niveauSelect.selectedIndex]?.text || 'Aucun niveau';
            
            if (filiereSelect.value === '') filiereTexte = 'Aucune filière';
            if (niveauSelect.value === '') niveauTexte = 'Aucun niveau';
            
            recapTexte.textContent = `${filiereTexte} - ${niveauTexte}`;
        }

        filiereSelect.addEventListener('change', updateRecap);
        niveauSelect.addEventListener('change', updateRecap);
        updateRecap();
    </script>
    @endpush
@endsection