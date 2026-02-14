{{-- 
    PAGE DE MODIFICATION D'UN TARIF
    Affiche un formulaire pré-rempli avec les données du tarif à modifier
--}}

@extends('layouts.app')

@section('title', 'Modifier un Tarif')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte contenant le formulaire --}}
            <div class="card">
                {{-- En-tête de la carte --}}
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Modifier le tarif
                    </h4>
                </div>

                {{-- Corps de la carte avec le formulaire --}}
                <div class="card-body">
                    {{-- 
                        Formulaire de modification
                        action: route vers update() avec l'ID du tarif
                        method: POST (mais on utilise @method('PUT') pour simuler PUT)
                    --}}
                    <form action="{{ route('tarifs.update', $tarif) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- CHAMP 1 : Sélection de la classe (désactivée en modification) --}}
                        <div class="mb-3">
                            <label for="classe_id" class="form-label">
                                Classe <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('classe_id') is-invalid @enderror" 
                                    id="classe_id" 
                                    name="classe_id" 
                                    required
                                    disabled>
                                <option value="">-- Choisir une classe --</option>
                                
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" 
                                        {{ old('classe_id', $tarif->classe_id) == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} 
                                        ({{ $classe->filiere->code ?? 'N/A' }} - 
                                        {{ $classe->niveau->nom_niveaux ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            
                            {{-- Champ caché pour quand même envoyer la valeur --}}
                            <input type="hidden" name="classe_id" value="{{ $tarif->classe_id }}">
                            
                            @error('classe_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                La classe ne peut pas être modifiée
                            </small>
                        </div>

                        {{-- CHAMP 2 : Sélection de l'année académique (désactivée en modification) --}}
                        <div class="mb-3">
                            <label for="annee_academique_id" class="form-label">
                                Année académique <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('annee_academique_id') is-invalid @enderror" 
                                    id="annee_academique_id" 
                                    name="annee_academique_id" 
                                    required
                                    disabled>
                                <option value="">-- Choisir une année --</option>
                                
                                @foreach($annees as $annee)
                                    <option value="{{ $annee->id_annee_ac }}" 
                                        {{ old('annee_academique_id', $tarif->annee_academique_id) == $annee->id_annee_ac ? 'selected' : '' }}>
                                        {{ $annee->annee_ac }}
                                    </option>
                                @endforeach
                            </select>
                            
                            {{-- Champ caché pour quand même envoyer la valeur --}}
                            <input type="hidden" name="annee_academique_id" value="{{ $tarif->annee_academique_id }}">
                            
                            @error('annee_academique_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                L'année ne peut pas être modifiée
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
                                       value="{{ old('inscription', $tarif->inscription) }}" 
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
                                       value="{{ old('mensualite', $tarif->mensualite) }}" 
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
                        </div>

                        {{-- CALCUL AUTOMATIQUE DU TOTAL --}}
                        <div class="alert alert-info">
                            <i class="fas fa-calculator me-2"></i>
                            <strong>Total annuel estimé :</strong>
                            <span id="totalAffiche">{{ number_format($tarif->inscription + ($tarif->mensualite * 10), 0, ',', ' ') }} FCFA</span>
                        </div>

                        {{-- ZONE DES BOUTONS D'ACTION --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tarifs.index') }}" class="btn btn-secondary">
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

            {{-- CARTE D'INFORMATION --}}
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informations sur le tarif
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>ID :</strong> {{ $tarif->id_tarifs }}
                        </li>
                        <li class="mb-2">
                            <strong>Date de création :</strong> 
                            {{ $tarif->created_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Dernière modification :</strong> 
                            {{ $tarif->updated_at->format('d/m/Y H:i') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT POUR LE CALCUL AUTOMATIQUE DU TOTAL --}}
    @push('scripts')
    <script>
        function calculerTotal() {
            let inscription = parseFloat(document.getElementById('inscription').value) || 0;
            let mensualite = parseFloat(document.getElementById('mensualite').value) || 0;
            let total = inscription + (mensualite * 10);
            let totalFormate = total.toLocaleString('fr-FR') + ' FCFA';
            document.getElementById('totalAffiche').textContent = totalFormate;
        }

        document.getElementById('inscription').addEventListener('input', calculerTotal);
        document.getElementById('mensualite').addEventListener('input', calculerTotal);
    </script>
    @endpush
@endsection