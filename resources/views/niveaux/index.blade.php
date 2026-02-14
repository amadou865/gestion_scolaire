@extends('layouts.app')

@section('title', 'Liste des Niveaux')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="fas fa-level-up-alt text-success me-2"></i>
            Niveaux
        </h1>
        <a href="{{ route('niveaux.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i>
            Nouveau niveau
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom du niveau</th>
                            <th>Catégorie</th>
                            <th>Nombre de classes</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($niveaux as $niveau)
                            <tr>
                                <td>{{ $niveau->id_niveaux }}</td>
                                <td>{{ $niveau->nom_niveaux }}</td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $niveau->categorie->categories_niveau ?? 'Non catégorisé' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $niveau->classes->count() }} classe(s)
                                    </span>
                                </td>
                                <td>{{ $niveau->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('niveaux.show', $niveau) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('niveaux.edit', $niveau) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('niveaux.destroy', $niveau) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Êtes-vous sûr ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-level-up-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aucun niveau trouvé</p>
                                    <a href="{{ route('niveaux.create') }}" class="btn btn-success">
                                        Créer le premier niveau
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{ $niveaux->links() }}
            </div>
        </div>
    </div>
@endsection