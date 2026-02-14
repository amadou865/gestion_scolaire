{{-- 
    PAGE DÉTAILS D'UN TARIF
    Affiche toutes les informations d'un tarif spécifique
--}}

@extends('layouts.app')

@section('title', 'Détails du Tarif')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte principale avec les détails --}}
            <div class="card">
                {{-- En-tête --}}
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Détails du tarif
                    </h4>
                </div>

                <div class="card-body">
                    {{-- INFORMATIONS DE LA CLASSE --}}
                    <div class="card bg-light mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-door-open me-2"></i>
                                Classe concernée
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Classe :</strong> {{ $tarif->classe->nom_classe ?? 'N/A' }}</p>
                                    <p><strong>Code :</strong> {{ $tarif->classe->code_classe ?? 'N/A' }}</p>
                                    <p><strong>Filière :</strong> {{ $tarif->classe->filiere->nom_filiere ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Niveau :</strong> {{ $tarif->classe->niveau->nom_niveaux ?? 'N/A' }}</p>
                                    <p><strong>Catégorie :</strong> {{ $tarif->classe->niveau->categorie->categories_niveau ?? 'N/A' }}</p>
                                    <p><strong>Capacité :</strong> {{ $tarif->classe->capacite ?? 'Non définie' }} élèves</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TABLEAU DES INFORMATIONS DU TARIF --}}
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px; background-color: #f8f9fa;">ID du tarif</th>
                            <td>{{ $tarif->id_tarifs }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Année académique</th>
                            <td>
                                <span class="badge bg-info p-2">
                                    {{ $tarif->anneeAcademique->annee_ac ?? 'N/A' }}
                                </span>
                                @if($tarif->anneeAcademique->is_active ?? false)
                                    <span class="badge bg-success ms-2">Année active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Frais d'inscription</th>
                            <td>
                                <span class="h5 text-primary">
                                    {{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Mensualité</th>
                            <td>
                                <span class="h5 text-success">
                                    {{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Total annuel (10 mois)</th>
                            <td>
                                @php
                                    $total = $tarif->inscription + ($tarif->mensualite * 10);
                                @endphp
                                <span class="h4 text-dark">
                                    {{ number_format($total, 0, ',', ' ') }} FCFA
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Date de création</th>
                            <td>
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ $tarif->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Dernière modification</th>
                            <td>
                                <i class="far fa-clock me-2"></i>
                                {{ $tarif->updated_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    </table>

                    {{-- GRAPHIQUE SIMPLE DES COÛTS --}}
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h6>Inscription unique</h6>
                                    <p class="display-6">{{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h6>Mensualité</h6>
                                    <p class="display-6">{{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RÉPARTITION MENSUELLE --}}
                    <div class="card mt-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Détail annuel</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Mois</th>
                                        <th class="text-end">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <td><strong>Inscription (unique)</strong></td>
                                        <td class="text-end">{{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA</td>
                                    </tr>
                                    @for($i = 1; $i <= 10; $i++)
                                        <tr>
                                            <td>Mensualité {{ $i }}</td>
                                            <td class="text-end">{{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                    @endfor
                                    <tr class="table-success">
                                        <th>TOTAL ANNUEL</th>
                                        <th class="text-end">{{ number_format($total, 0, ',', ' ') }} FCFA</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- BOUTONS D'ACTION --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('tarifs.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Retour à la liste
                        </a>
                        
                        <div>
                            <a href="{{ route('tarifs.edit', $tarif) }}" 
                               class="btn btn-warning me-2">
                                <i class="fas fa-edit me-2"></i>
                                Modifier
                            </a>
                            <form action="{{ route('tarifs.destroy', $tarif) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tarif ?')">
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