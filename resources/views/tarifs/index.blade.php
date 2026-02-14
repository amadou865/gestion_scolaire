{{-- 
    PAGE LISTE DES TARIFS
    Affiche tous les tarifs dans un tableau avec leurs relations
--}}

@extends('layouts.app')

@section('title', 'Liste des Tarifs')

@section('content')
    {{-- En-tête avec bouton d'ajout --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="fas fa-money-bill-wave text-success me-2"></i>
            Tarifs
        </h1>
        <a href="{{ route('tarifs.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i>
            Nouveau tarif
        </a>
    </div>

    {{-- Carte contenant le tableau --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Classe</th>
                            <th>Filière</th>
                            <th>Niveau</th>
                            <th>Année</th>
                            <th>Inscription</th>
                            <th>Mensualité</th>
                            <th>Total annuel</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Si aucun tarif --}}
                        @forelse($tarif as $tarif)
                            <tr>
                                <td>{{ $tarif->id_tarifs }}</td>
                                
                                {{-- Classe --}}
                                <td>
                                    <strong>{{ $tarif->classe->nom_classe ?? 'N/A' }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $tarif->classe->code_classe ?? '' }}</small>
                                </td>
                                
                                {{-- Filière --}}
                                <td>{{ $tarif->classe->filiere->nom_filiere ?? 'N/A' }}</td>
                                
                                {{-- Niveau --}}
                                <td>{{ $tarif->classe->niveau->nom_niveaux ?? 'N/A' }}</td>
                                
                                {{-- Année académique --}}
                                <td>
                                    <span class="badge bg-info">
                                        {{ $tarif->anneeAcademique->annee_ac ?? 'N/A' }}
                                    </span>
                                </td>
                                
                                {{-- Inscription --}}
                                <td>
                                    <span class="badge bg-primary">
                                        {{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA
                                    </span>
                                </td>
                                
                                {{-- Mensualité --}}
                                <td>
                                    <span class="badge bg-success">
                                        {{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA
                                    </span>
                                </td>
                                
                                {{-- Total annuel (10 mois) --}}
                                <td>
                                    @php
                                        $total = $tarif->inscription + ($tarif->mensualite * 10);
                                    @endphp
                                    <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                                </td>
                                
                                {{-- Boutons d'action --}}
                                <td>
                                    <a href="{{ route('tarifs.show', $tarif) }}" 
                                       class="btn btn-sm btn-info" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('tarifs.edit', $tarif) }}" 
                                       class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tarifs.destroy', $tarif) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tarif ?')"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <i class="fas fa-money-bill-wave fa-4x text-muted mb-3"></i>
                                    <p class="text-muted h5">Aucun tarif trouvé</p>
                                    <p class="text-muted mb-3">Commencez par créer un tarif pour une classe</p>
                                    <a href="{{ route('tarifs.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus-circle me-2"></i>
                                        Créer le premier tarif
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $tarif->links() }}
            </div>
        </div>
    </div>
@endsection