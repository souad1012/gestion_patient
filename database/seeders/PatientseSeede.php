<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $patients = [
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'telephone' => '0612345678',
                'date_naissance' => '1980-05-15',
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Sophie',
                'telephone' => '0687654321',
                'date_naissance' => '1992-11-23',
            ],
            [
                'nom' => 'Dubois',
                'prenom' => 'Pierre',
                'telephone' => '0654321987',
                'date_naissance' => '1975-08-30',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}