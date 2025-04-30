
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1><i class="fas fa-door-open"></i> Gestion des Salles</h1>
    </div>
    <div>
        <a href="{{ route('salles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle salle
        </a>
    </div>
</div>

<div class="row mb-4">
    @foreach($salles as $salle)
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ $salle->nom }}</h5>
                <span class="badge {{ $salle->disponible ? 'badge-disponible' : 'badge-occupe' }}">
                    {{ $salle->disponible ? 'Disponible' : 'Occupée' }}
                </span>
            </div>
            <div class="card-body">
                <p><strong>Type:</strong> {{ $salle->type }}</p>
                <p><strong>Capacité:</strong> {{ $salle->capacite }} personnes</p>
                <p><strong>Patients en attente:</strong> {{ $salle->fileAttentes->where('statut', 'en_attente')->count() }}</p>
                @if($salle->fileAttentes->where('statut', 'en_attente')->count() > 0)
                    <p><strong>Premier arrivé:</strong> 
                        {{ $salle->fileAttentes->where('statut', 'en_attente')->sortBy('position')->first()->patient->prenom }} 
                        {{ $salle->fileAttentes->where('statut', 'en_attente')->sortBy('position')->first()->patient->nom }}
                    </p>
                @endif
            </div>
            <div class="card-footer">
                <div class="btn-group w-100" role="group">
                    <a href="{{ route('salles.show', $salle->id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('salles.edit', $salle->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="{{ route('salles.file_attente', $salle->id) }}" class="btn btn-primary">
                        <i class="fas fa-clock"></i> File d'attente
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <h5>Liste des salles</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Capacité</th>
                        <th>Disponibilité</th>
                        <th>Patients en attente</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salles as $salle)
                    <tr>
                        <td>{{ $salle->id }}</td>
                        <td>{{ $salle->nom }}</td>
                        <td>{{ $salle->type }}</td>
                        <td>{{ $salle->capacite }}</td>
                        <td>
                            <span class="badge {{ $salle->disponible ? 'badge-disponible' : 'badge-occupe' }}">
                                {{ $salle->disponible ? 'Disponible' : 'Occupée' }}
                            </span>
                        </td>
                        <td>{{ $salle->fileAttentes->where('statut', 'en_attente')->count() }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('salles.show', $salle->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="{{ route('salles.edit', $salle->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <a href="{{ route('salles.file_attente', $salle->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-clock"></i> File d'attente
                                </a>
                                <form action="{{ route('salles.destroy', $salle->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette salle?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection