{{-- 
    PAGE DÉTAILS D'UNE ANNÉE ACADÉMIQUE
    Affiche toutes les informations d'une année spécifique
--}}

@extends('layouts.app')

@section('title', 'Détails de l\'Année Académique')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte principale avec les détails --}}
            <div class="card">
                {{-- En-tête --}}
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Détails de l'année : {{ $anneeAcademique->annee_ac }}
                    </h4>
                </div>

                <div class="card-body">
                    {{-- TABLEAU DES INFORMATIONS --}}
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px; background-color: #f8f9fa;">ID</th>
                            <td>{{ $anneeAcademique->id_annee_ac }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Année académique</th>
                            <td>
                                <span class="h5">{{ $anneeAcademique->annee_ac }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Date de début</th>
                            <td>
                                @if($anneeAcademique->date_debut)
                                    <i class="far fa-calendar-alt me-2"></i>
                                    {{ $anneeAcademique->date_debut->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">Non définie</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Date de fin</th>
                            <td>
                                @if($anneeAcademique->date_fin)
                                    <i class="far fa-calendar-alt me-2"></i>
                                    {{ $anneeAcademique->date_fin->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">Non définie</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Statut</th>
                            <td>
                                @if($anneeAcademique->is_active)
                                    <span class="badge bg-success p-2">
                                        <i class="fas fa-check-circle me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary p-2">
                                        <i class="fas fa-times-circle me-1"></i> Inactive
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Date de création</th>
                            <td>
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ $anneeAcademique->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Dernière modification</th>
                            <td>
                                <i class="far fa-clock me-2"></i>
                                {{ $anneeAcademique->updated_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    </table>

                    {{-- SECTION DES TARIFS ASSOCIÉS --}}
                    <h5 class="mt-4 mb-3">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        Tarifs pour cette année ({{ $anneeAcademique->tarifs->count() }})
                    </h5>

                    @if($anneeAcademique->tarifs->count() > 0)
                        {{-- Tableau des tarifs --}}
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Classe</th>
                                        <th>Filière</th>
                                        <th>Niveau</th>
                                        <th>Inscription</th>
                                        <th>Mensualité</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($anneeAcademique->tarifs as $tarif)
                                        <tr>
                                            <td>
                                                <strong>{{ $tarif->classe->nom_classe ?? 'N/A' }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $tarif->classe->code_classe ?? '' }}</small>
                                            </td>
                                            <td>{{ $tarif->classe->filiere->nom_filiere ?? 'N/A' }}</td>
                                            <td>{{ $tarif->classe->niveau->nom_niveaux ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    {{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('tarifs.show', $tarif) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{-- Message si aucun tarif --}}
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Aucun tarif n'est associé à cette année académique.
                        </div>
                    @endif

                    {{-- STATISTIQUES RAPIDES --}}
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="text-muted">Total tarifs</h6>
                                    <p class="display-6">{{ $anneeAcademique->tarifs->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="text-muted">Classes concernées</h6>
                                    <p class="display-6">{{ $anneeAcademique->tarifs->groupBy('classe_id')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="text-muted">Mensualité moyenne</h6>
                                    <p class="h5">
                                        @php
                                            $moyenne = $anneeAcademique->tarifs->avg('mensualite');
                                        @endphp
                                        {{ $moyenne ? number_format($moyenne, 0, ',', ' ') : '0' }} FCFA
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- BOUTONS D'ACTION --}}
                    <div class="d-flex justify-content-between mt-4">
                        {{-- Bouton retour --}}
                        <a href="{{ route('annee-academiques.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Retour à la liste
                        </a>
                        
                        <div>
                            {{-- Bouton modifier --}}
                            <a href="{{ route('annee-academiques.edit', $anneeAcademique) }}" 
                               class="btn btn-warning me-2">
                                <i class="fas fa-edit me-2"></i>
                                Modifier
                            </a>
                            
                            {{-- Bouton supprimer (avec confirmation) --}}
                            <form action="{{ route('annee-academiques.destroy', $anneeAcademique) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette année ?\n\n⚠️ Attention : {{ $anneeAcademique->tarifs->count() }} tarif(s) sont associés à cette année et seront également supprimés !')">
                                    <i class="fas fa-trash me-2"></i>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection