{{-- 
    PAGE LISTE DES CATÉGORIES
    Affiche toutes les catégories dans un tableau
--}}

@extends('layouts.app')

@section('title', 'Liste des Catégories')

@section('content')
    {{-- En-tête avec bouton d'ajout --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="fas fa-tags text-primary me-2"></i>
            Catégories de Niveaux
        </h1>
        <a href="{{ route('categorie-niveaux.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>
            Nouvelle catégorie
        </a>
    </div>

    {{-- Tableau des catégories --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom de la catégorie</th>
                            <th>Description</th>
                            <th>Nombre de niveaux</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Si aucune catégorie --}}
                        @forelse($categories as $categorie)
                            <tr>
                                <td>{{ $categorie->id_categorieNiveaux }}</td>
                                <td>{{ $categorie->categories_niveau }}</td>
                                <td>{{ Str::limit($categorie->description, 50) ?: '—' }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $categorie->niveaux->count() }} niveau(x)
                                    </span>
                                </td>
                                <td>{{ $categorie->created_at->format('d/m/Y') }}</td>
                                <td>
                                    {{-- Bouton Voir --}}
                                    <a href="{{ route('categorie-niveaux.show', $categorie) }}" 
                                       class="btn btn-sm btn-info" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    {{-- Bouton Modifier --}}
                                    <a href="{{ route('categorie-niveaux.edit', $categorie) }}" 
                                       class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    {{-- Bouton Supprimer --}}
                                    <form action="{{ route('categorie-niveaux.destroy', $categorie) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aucune catégorie trouvée</p>
                                    <a href="{{ route('categorie-niveaux.create') }}" class="btn btn-primary">
                                        Créer la première catégorie
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection