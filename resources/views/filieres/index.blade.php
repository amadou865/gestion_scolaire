@extends('layouts.app')

@section('title', 'Liste des Filières')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="fas fa-graduation-cap text-info me-2"></i>
            Filières
        </h1>
        <a href="{{ route('filieres.create') }}" class="btn btn-info">
            <i class="fas fa-plus-circle me-2"></i>
            Nouvelle filière
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Nom de la filière</th>
                            <th>Description</th>
                            <th>Nombre de classes</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($filiere as $filiere)
                            <tr>
                                <td>{{ $filiere->id }}</td>
                                <td><span class="badge bg-secondary">{{ $filiere->code }}</span></td>
                                <td>{{ $filiere->nom_filiere }}</td>
                                <td>{{ Str::limit($filiere->description, 50) ?: '—' }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $filiere->classes_count }} classe(s)
                                    </span>
                                </td>
                                <td>{{ $filiere->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('filieres.show', $filiere) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('filieres.edit', $filiere) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('filieres.destroy', $filiere) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aucune filière trouvée</p>
                                    <a href="{{ route('filieres.create') }}" class="btn btn-info">
                                        Créer la première filière
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{ $filiere->links() }}
            </div>
        </div>
    </div>
@endsection