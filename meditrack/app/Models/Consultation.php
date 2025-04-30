<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'rendez_vous_id',
        'salle_id',
        'heure_debut',
        'heure_fin',
        'type',
        'notes',
        'statut',
    ];

    protected $casts = [
        'heure_debut' => 'datetime',
        'heure_fin' => 'datetime',
    ];

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class);
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function fileAttente()
    {
        return $this->hasOne(FileAttente::class);
    }
}