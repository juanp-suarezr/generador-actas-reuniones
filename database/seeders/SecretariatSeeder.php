<?php

namespace Database\Seeders;

use App\Models\Secretariat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecretariatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $secretariats = [
            'Secretaría de Gobierno',
            'Secretaría de Hacienda',
            'Secretaría de Planeación',
            'Secretaría de Infraestructura',
            'Secretaría de Educación',
            'Secretaría de Salud',
            'Secretaría de Ambiente',
            'Secretaría de Desarrollo Social',
            'Otro',
        ];

        foreach ($secretariats as $name) {
            Secretariat::create(['name' => $name]);
        }
    }
}
