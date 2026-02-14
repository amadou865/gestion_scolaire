{{-- 
    PAGE DE CRÉATION D'UN TARIF
    Affiche un formulaire pour créer un nouveau tarif
--}}

@extends('layouts.app')

@section('title', 'Nouveau Tarif')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte contenant le formulaire --}}
            <div class="card">
                {{-- En-tête de la carte --}}
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nouveau tarif
                    </h4>
                </div>

                {{-- Corps de la carte avec le formulaire --}}
                <div class="card-body">
                    {{-- 
                        Formulaire de création
                        action: route vers store()
                        method: POST
                    --}}
                    <form action="{{ route('tarifs.store') }}" method="POST">
                        @csrf {{-- Protection CSRF obligatoire --}}

                        {{-- CHAMP 1 : Sélection de la classe --}}
                        <div class="mb-3">
                            <label for="classe_id" class="form-label">
                                Classe <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('classe_id') is-invalid @enderror" 
                                    id="classe_id" 
                                    name="classe_id" 
                                    required>
                                <option value="">-- Choisir une classe --</option>
                                
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" 
                                        {{ old('classe_id') == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} 
                                        ({{ $classe->filiere->code ?? 'N/A' }} - 
                                        {{ $classe->niveau->nom_niveaux ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('classe_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- CHAMP 2 : Sélection de l'année académique --}}
                        <div class="mb-3">
                            <label for="annee_academique_id" class="form-label">
                                Année académique <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('annee_academique_id') is-invalid @enderror" 
                                    id="annee_academique_id" 
                                    name="annee_academique_id" 
                                    required>
                                <option value="">-- Choisir une année --</option>
                                
                                @foreach($annees as $annee)
                                    <option value="{{ $annee->id_annee_ac }}" 
                                        {{ old('annee_academique_id') == $annee->id_annee_ac ? 'selected' : '' }}
                                        {{ $annee->is_active ? 'class=bg-warning' : '' }}>
                                        {{ $annee->annee_ac }}
                                        @if($annee->is_active)
                                            (Active)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('annee_academique_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Les années actives sont surlignées en jaune
                            </small>
                        </div>

                        {{-- CHAMP 3 : Montant de l'inscription --}}
                        <div class="mb-3">
                            <label for="inscription" class="form-label">
                                Frais d'inscription <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       class="form-control @error('inscription') is-invalid @enderror" 
                                       id="inscription" 
                                       name="inscription" 
                                       value="{{ old('inscription') }}" 
                                       step="100" 
                                       min="0"
                                       required>
                                <span class="input-group-text">FCFA</span>
                                @error('inscription')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Montant en FCFA (ex: 50000)
                            </small>
                        </div>

                        {{-- CHAMP 4 : Montant de la mensualité --}}
                        <div class="mb-3">
                            <label for="mensualite" class="form-label">
                                Mensualité <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       class="form-control @error('mensualite') is-invalid @enderror" 
                                       id="mensualite" 
                                       name="mensualite" 
                                       value="{{ old('mensualite') }}" 
                                       step="100" 
                                       min="0"
                                       required>
                                <span class="input-group-text">FCFA</span>
                                @error('mensualite')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Montant mensuel en FCFA (ex: 25000)
                            </small>
                        </div>

                        {{-- CALCUL AUTOMATIQUE DU TOTAL --}}
                        <div class="alert alert-info">
                            <i class="fas fa-calculator me-2"></i>
                            <strong>Total annuel estimé :</strong>
                            <span id="totalAffiche">0 FCFA</span>
                            <br>
                            <small>(Inscription + 10 mensualités)</small>
                        </div>

                        {{-- ZONE DES BOUTONS D'ACTION --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tarifs.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>
                                Créer le tarif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT POUR LE CALCUL AUTOMATIQUE DU TOTAL --}}
    @push('scripts')
    <script>
        // Fonction pour calculer et afficher le total
        function calculerTotal() {
            let inscription = parseFloat(document.getElementById('inscription').value) || 0;
            let mensualite = parseFloat(document.getElementById('mensualite').value) || 0;
            let total = inscription + (mensualite * 10);
            
            // Formater le nombre
            let totalFormate = total.toLocaleString('fr-FR') + ' FCFA';
            document.getElementById('totalAffiche').textContent = totalFormate;
        }

        // Écouter les changements sur les champs
        document.getElementById('inscription').addEventListener('input', calculerTotal);
        document.getElementById('mensualite').addEventListener('input', calculerTotal);
        
        // Calcul initial
        calculerTotal();
    </script>
    @endpush
@endsection