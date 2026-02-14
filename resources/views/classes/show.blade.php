{{-- 
    PAGE DÉTAILS D'UNE CLASSE
    Affiche toutes les informations d'une classe spécifique
--}}

@extends('layouts.app')

@section('title', 'Détails de la Classe')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte principale avec les détails --}}
            <div class="card">
                {{-- En-tête --}}
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Détails de la classe : {{ $classe->nom_classe }}
                    </h4>
                </div>

                <div class="card-body">
                    {{-- INFORMATIONS PRINCIPALES --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">
                                        <i class="fas fa-tag me-2"></i>Identifiants
                                    </h5>
                                    <p><strong>ID :</strong> {{ $classe->id_classe }}</p>
                                    <p><strong>Code :</strong> 
                                        <span class="badge bg-secondary">{{ $classe->code_classe }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title text-success">
                                        <i class="fas fa-users me-2"></i>Capacité
                                    </h5>
                                    <p class="display-6">
                                        {{ $classe->capacite ?? 'Non définie' }}
                                        @if($classe->capacite)
                                            <small class="text-muted">élèves</small>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- INFORMATIONS DÉTAILLÉES --}}
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px; background-color: #f8f9fa;">Filière</th>
                            <td>
                                @if($classe->filiere)
                                    <strong>{{ $classe->filiere->nom_filiere }}</strong>
                                    <br>
                                    <small class="text-muted">Code: {{ $classe->filiere->code }}</small>
                                @else
                                    <span class="text-muted">Non définie</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Niveau</th>
                            <td>
                                @if($classe->niveau)
                                    <strong>{{ $classe->niveau->nom_niveaux }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        Catégorie: {{ $classe->niveau->categorie->categories_niveau ?? 'N/A' }}
                                    </small>
                                @else
                                    <span class="text-muted">Non défini</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Date de création</th>
                            <td>
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ $classe->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Dernière modification</th>
                            <td>
                                <i class="far fa-clock me-2"></i>
                                {{ $classe->updated_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    </table>

                    {{-- SECTION DES TARIFS ASSOCIÉS --}}
                    <h5 class="mt-4 mb-3">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        Tarifs pour cette classe ({{ $classe->tarifs->count() }})
                    </h5>

                    @if($classe->tarifs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Année</th>
                                        <th>Inscription</th>
                                        <th>Mensualité</th>
                                        <th>Total annuel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classe->tarifs as $tarif)
                                        @php
                                            $total = $tarif->inscription + ($tarif->mensualite * 10);
                                        @endphp
                                        <tr>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $tarif->anneeAcademique->annee_ac ?? 'N/A' }}
                                                </span>
                                                @if($tarif->anneeAcademique->is_active ?? false)
                                                    <span class="badge bg-success">Active</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA</td>
                                            <td>{{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA</td>
                                            <td><strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong></td>
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
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Aucun tarif n'est associé à cette classe.
                            <a href="{{ route('tarifs.create') }}" class="alert-link">Créer un tarif</a>
                        </div>
                    @endif

                    {{-- STATISTIQUES --}}
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h6>Inscription moyenne</h6>
                                    <p class="h4">
                                        @php
                                            $moyenneInscription = $classe->tarifs->avg('inscription');
                                        @endphp
                                        {{ $moyenneInscription ? number_format($moyenneInscription, 0, ',', ' ') : '0' }} FCFA
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h6>Mensualité moyenne</h6>
                                    <p class="h4">
                                        @php
                                            $moyenneMensualite = $classe->tarifs->avg('mensualite');
                                        @endphp
                                        {{ $moyenneMensualite ? number_format($moyenneMensualite, 0, ',', ' ') : '0' }} FCFA
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning">
                                <div class="card-body text-center">
                                    <h6>Total annuel moyen</h6>
                                    <p class="h4">
                                        @php
                                            $moyenneTotale = $classe->tarifs->avg(function($t) {
                                                return $t->inscription + ($t->mensualite * 10);
                                            });
                                        @endphp
                                        {{ $moyenneTotale ? number_format($moyenneTotale, 0, ',', ' ') : '0' }} FCFA
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- BOUTONS D'ACTION --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Retour à la liste
                        </a>
                        
                        <div>
                            <a href="{{ route('classes.edit', $classe) }}" 
                               class="btn btn-warning me-2">
                                <i class="fas fa-edit me-2"></i>
                                Modifier
                            </a>
                            <form action="{{ route('classes.destroy', $classe) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?\n\n⚠️ Attention : {{ $classe->tarifs->count() }} tarif(s) seront également supprimés !')">
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