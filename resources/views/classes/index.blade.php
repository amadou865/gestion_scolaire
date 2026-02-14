{{-- 
    PAGE LISTE DES CLASSES
    Affiche toutes les classes dans un tableau avec leurs relations
--}}

@extends('layouts.app')

@section('title', 'Liste des Classes')

@section('content')
    {{-- En-tête avec bouton d'ajout --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="fas fa-door-open text-danger me-2"></i>
            Classes
        </h1>
        <a href="{{ route('classes.create') }}" class="btn btn-danger">
            <i class="fas fa-plus-circle me-2"></i>
            Nouvelle classe
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
                            <th>Code</th>
                            <th>Nom de la classe</th>
                            <th>Filière</th>
                            <th>Niveau</th>
                            <th>Capacité</th>
                            <th>Tarifs</th>
                            <th>Date création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Si aucune classe --}}
                        @forelse($classes as $classe)
                            <tr>
                                <td>{{ $classe->id_classe }}</td>
                                
                                {{-- Code --}}
                                <td>
                                    <span class="badge bg-secondary">{{ $classe->code_classe }}</span>
                                </td>
                                
                                {{-- Nom de la classe --}}
                                <td>
                                    <strong>{{ $classe->nom_classe }}</strong>
                                </td>
                                
                                {{-- Filière --}}
                                <td>
                                    @if($classe->filiere)
                                        <span class="badge bg-info">
                                            {{ $classe->filiere->code }}
                                        </span>
                                        <br>
                                        <small>{{ $classe->filiere->nom_filiere }}</small>
                                    @else
                                        <span class="text-muted">Non définie</span>
                                    @endif
                                </td>
                                
                                {{-- Niveau --}}
                                <td>
                                    @if($classe->niveau)
                                        {{ $classe->niveau->nom_niveaux }}
                                        <br>
                                        <small class="text-muted">
                                            ({{ $classe->niveau->categorie->categories_niveau ?? 'N/A' }})
                                        </small>
                                    @else
                                        <span class="text-muted">Non défini</span>
                                    @endif
                                </td>
                                
                                {{-- Capacité --}}
                                <td>
                                    @if($classe->capacite)
                                        <span class="badge bg-warning">
                                            {{ $classe->capacite }} élèves
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                
                                {{-- Nombre de tarifs --}}
                                <td>
                                    <span class="badge bg-success">
                                        {{ $classe->tarifs->count() }} tarif(s)
                                    </span>
                                </td>
                                
                                {{-- Date de création --}}
                                <td>{{ $classe->created_at->format('d/m/Y') }}</td>
                                
                                {{-- Boutons d'action --}}
                                <td>
                                    <a href="{{ route('classes.show', $classe) }}" 
                                       class="btn btn-sm btn-info" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('classes.edit', $classe) }}" 
                                       class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('classes.destroy', $classe) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?\n\n⚠️ Attention : {{ $classe->tarifs->count() }} tarif(s) sont associés à cette classe et seront également supprimés !')"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <i class="fas fa-door-open fa-4x text-muted mb-3"></i>
                                    <p class="text-muted h5">Aucune classe trouvée</p>
                                    <p class="text-muted mb-3">Commencez par créer une classe</p>
                                    <a href="{{ route('classes.create') }}" class="btn btn-danger">
                                        <i class="fas fa-plus-circle me-2"></i>
                                        Créer la première classe
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $classes->links() }}
            </div>
        </div>
    </div>
@endsection