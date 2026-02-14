@extends('layouts.app')

@section('title', 'Années Académiques')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="fas fa-calendar-alt text-warning me-2"></i>
            Années Académiques
        </h1>
        <a href="{{ route('annee-academiques.create') }}" class="btn btn-warning">
            <i class="fas fa-plus-circle me-2"></i>
            Nouvelle année
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Année</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Statut</th>
                            <th>Nombre de tarifs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($annee_academique as $annee)
                            <tr>
                                <td>{{ $annee->id_annee_ac }}</td>
                                <td><strong>{{ $annee->annee_ac }}</strong></td>
                                <td>{{ $annee->date_debut ? $annee->date_debut->format('d/m/Y') : '—' }}</td>
                                <td>{{ $annee->date_fin ? $annee->date_fin->format('d/m/Y') : '—' }}</td>
                                <td>
                                    @if($annee->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $annee->tarifs->count() }} tarif(s)
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('annee-academiques.show', $annee) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('annee-academiques.edit', $annee) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('annee-academiques.destroy', $annee) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette année ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aucune année académique trouvée</p>
                                    <a href="{{ route('annee-academiques.create') }}" class="btn btn-warning">
                                        Créer la première année
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{ $annee_academique->links() }}
            </div>
        </div>
    </div>
@endsection