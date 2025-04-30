@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="mb-4">Tableau de bord</h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <i class="fas fa-user-injured icon-card"></i>
                <h5 class="card-title">Patients</h5>
                <p class="card-text">Gestion des patients</p>
                <a href="{{ route('patients.index') }}" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <i class="fas fa-door-open icon-card"></i>
                <h5 class="card-title">Salles</h5>
                <p class="card-text">Gestion des salles</p>
                <a href="{{ route('salles.index') }}" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <i class="fas fa-calendar-check icon-card"></i>
                <h5 class="card-title">Consultations</h5>
                <p class="card-text">Gestion des consultations</p>
                <a href="{{ route('consultations.index') }}" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <i class="fas fa-clock icon-card"></i>
                <h5 class="card-title">File d'attente</h5>
                <p class="card-text">Gestion de la file d'attente</p>
                <a href="{{ route('file-attentes.index') }}" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>État des salles</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($salles as $salle)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>{{ $salle->nom }}</h5>
                                <span class="badge {{ $salle->disponible ? 'badge-disponible' : 'badge-occupe' }}">
                                    {{ $salle->disponible ? 'Disponible' : 'Occupée' }}
                                </span>
                            </div>
                            <div class="card-body">
                                <p><strong>Type:</strong> {{ $salle->type }}</p>
                                <p><strong>Capacité:</strong> {{ $salle->capacite }} personnes</p>
                                <p><strong>Patients en attente:</strong> {{ $salle->patients_en_attente }}</p>
                                @if($salle->patients_en_attente > 0)
                                    <a href="{{ route('salles.file_attente', $salle->id) }}" class="btn btn-primary">Voir file d'attente</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
