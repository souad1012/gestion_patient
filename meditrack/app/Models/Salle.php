<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'capacite',
        'disponible',
    ];

    protected $casts = [
        'disponible' => 'boolean',
    ];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function fileAttentes()
    {
        return $this->hasManyThrough(FileAttente::class, Consultation::class);
    }
}
