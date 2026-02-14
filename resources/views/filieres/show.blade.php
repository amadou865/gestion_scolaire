{{-- 
    PAGE DÉTAILS D'UNE FILIÈRE
    Affiche toutes les informations d'une filière spécifique
--}}

@extends('layouts.app')

@section('title', 'Détails de la Filière')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            {{-- Carte principale avec les détails --}}
            <div class="card">
                {{-- En-tête --}}
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Détails de la filière : {{ $filiere->nom_filiere }}
                    </h4>
                </div>

                <div class="card-body">
                    {{-- TABLEAU DES INFORMATIONS --}}
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px; background-color: #f8f9fa;">ID</th>
                            <td>{{ $filiere->id }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Code</th>
                            <td>
                                <span class="badge bg-secondary p-2">{{ $filiere->code }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Nom de la filière</th>
                            <td>
                                <span class="h5">{{ $filiere->nom_filiere }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Description</th>
                            <td>
                                @if($filiere->description)
                                    {{ $filiere->description }}
                                @else
                                    <span class="text-muted">Aucune description</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Date de création</th>
                            <td>
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ $filiere->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Dernière modification</th>
                            <td>
                                <i class="far fa-clock me-2"></i>
                                {{ $filiere->updated_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    </table>

                    {{-- SECTION DES CLASSES ASSOCIÉES --}}
                    <h5 class="mt-4 mb-3">
                        <i class="fas fa-door-open me-2"></i>
                        Classes dans cette filière ({{ $filiere->classes->count() }})
                    </h5>

                    @if($filiere->classes->count() > 0)
                        {{-- Tableau des classes --}}
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Nom de la classe</th>
                                        <th>Niveau</th>
                                        <th>Capacité</th>
                                        <th>Tarifs</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($filiere->classes as $classe)
                                        <tr>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $classe->code_classe }}
                                                </span>
                                            </td>
                                            <td>{{ $classe->nom_classe }}</td>
                                            <td>{{ $classe->niveau->nom_niveaux ?? 'N/A' }}</td>
                                            <td>{{ $classe->capacite ?? '—' }} élèves</td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $classe->tarifs->count() }} tarif(s)
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('classes.show', $classe) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- STATISTIQUES DES CLASSES --}}
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted">Total classes</h6>
                                        <p class="display-6">{{ $filiere->classes->count() }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted">Capacité totale</h6>
                                        <p class="display-6">
                                            {{ $filiere->classes->sum('capacite') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted">Niveaux différents</h6>
                                        <p class="display-6">
                                            {{ $filiere->classes->groupBy('niveaux_id')->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        {{-- Message si aucune classe --}}
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Aucune classe n'est associée à cette filière pour le moment.
                        </div>
                    @endif

                    {{-- BOUTONS D'ACTION --}}
                    <div class="d-flex justify-content-between mt-4">
                        {{-- Bouton retour --}}
                        <a href="{{ route('filieres.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Retour à la liste
                        </a>
                        
                        <div>
                            {{-- Bouton modifier --}}
                            <a href="{{ route('filieres.edit', $filiere) }}" 
                               class="btn btn-warning me-2">
                                <i class="fas fa-edit me-2"></i>
                                Modifier
                            </a>
                            
                            {{-- Bouton supprimer (avec confirmation) --}}
                            <form action="{{ route('filieres.destroy', $filiere) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?\n\n⚠️ Attention : {{ $filiere->classes->count() }} classe(s) sont associées à cette filière et seront également supprimées !')">
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