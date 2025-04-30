<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileAttente extends Model
{
    use HasFactory;

    protected $table = 'file_attentes';

    protected $fillable = [
        'patient_id',
        'consultation_id',
        'heure_arrivee',
        'position',
        'statut',
    ];

    protected $casts = [
        'heure_arrivee' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}