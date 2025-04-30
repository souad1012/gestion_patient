@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1><i class="fas fa-user-injured"></i> Gestion des Patients</h1>
    </div>
    <div>
        <a href="{{ route('patients.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau patient
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h5>Rechercher un patient</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par nom, prénom ou téléphone">
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>Liste des patients</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Date de naissance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->nom }}</td>
                        <td>{{ $patient->prenom }}</td>
                        <td>{{ $patient->telephone }}</td>
                        <td>{{ $patient->date_naissance->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <a href="{{ route('patients.file_attente', $patient->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-clock"></i> File d'attente
                                </a>
                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce patient?')">
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

@section('scripts')
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection