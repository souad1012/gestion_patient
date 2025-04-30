<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\FileAttenteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes pour les patients
Route::resource('patients', PatientController::class);
Route::get('patients/{patient}/file-attente', [PatientController::class, 'fileAttente'])->name('patients.file_attente');

// Routes pour les salles
Route::resource('salles', SalleController::class);
Route::get('salles/{salle}/file-attente', [SalleController::class, 'fileAttente'])->name('salles.file_attente');

// Routes pour les rendez-vous
Route::resource('rendez-vous', RendezVousController::class, ['parameters' => [
    'rendez-vous' => 'rendezVous'
]]);

// Routes pour les consultations
Route::resource('consultations', ConsultationController::class);

// Routes pour la file d'attente
Route::resource('file-attentes', FileAttenteController::class, ['parameters' => [
    'file-attentes' => 'fileAttente'
]]);