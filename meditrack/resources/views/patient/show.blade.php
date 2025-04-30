@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user"></i> Détails du Patient</h1>
    <div>
        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Modifier
        </a>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations personnelles</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th style="width: 30%">ID</th>
                        <td>{{ $patient->id }}</td>
                    </tr>
                    <tr>
                        <th>Nom</th>
                        <td>{{ $patient->nom }}</td>
                    </tr>
                    <tr>
                        <th>Prénom</th>
                        <td>{{ $patient->prenom }}</td>
                    </tr>
                    <tr>
                        <th>Téléphone</th>
                        <td>{{ $patient->telephone }}</td>
                    </tr>
                    <tr>
                        <th>Date de naissance</th>
                        <td>{{ $patient->date_naissance->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Âge</th>
                        <td>{{ $patient->date_naissance->age }} ans</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>File d'attente</h5>
                <a href="{{ route('patients.file_attente', $patient->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-clock"></i> Voir détails
                </a>
            </div>
            <div class="card-body">
                @if($patient->fileAttentes->where('statut', 'en_attente')->count() > 0)
                    <div class="alert alert-info">
                        Ce patient est actuellement dans la file d'attente.
                    </div>
                    <table class="table">
                        <tr>
                            <th>Position</th>
                            <td>{{ $patient->fileAttentes->where('statut', 'en_attente')->first()->position }}</td>
                        </tr>
                        <tr>
                            <th>Heure d'arrivée</th>
                            <td>{{ $patient->fileAttentes->where('statut', 'en_attente')->first()->heure_arrivee->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Salle</th>
                            <td>
                                @if($patient->fileAttentes->where('statut', 'en_attente')->first()->consultation)
                                    {{ $patient->fileAttentes->where('statut', 'en_attente')->first()->consultation->salle->nom }}
                                @else
                                    Non assigné
                                @endif
                            </td>
                        </tr>
                    </table>
                @else
                    <div class="alert alert-secondary">
                        Ce patient n'est pas actuellement dans la file d'attente.
                    </div>
                    <a href="{{ route('file-attentes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter à la file d'attente
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Historique des consultations</h5>
                <a href="{{ route('consultations.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle consultation
                </a>
            </div>
            <div class="card-body">
                @if($patient->rendezVous->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Salle</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patient->rendezVous as $rdv)
                                @if($rdv->consultation)
                                <tr>
                                    <td>{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                                    <td>{{ $rdv->consultation->type }}</td>
                                    <td>{{ $rdv->consultation->salle->nom }}</td>
                                    <td>
                                        @if($rdv->consultation->statut == 'terminee')
                                            <span class="badge bg-success">Terminée</span>
                                        @elseif($rdv->consultation->statut == 'en_cours')
                                            <span class="badge bg-primary">En cours</span>
                                        @else
                                            <span class="badge bg-secondary">En attente</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('consultations.show', $rdv->consultation->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        Aucune consultation pour ce patient.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection