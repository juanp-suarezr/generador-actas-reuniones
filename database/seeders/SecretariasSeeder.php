<?php

namespace Database\Seeders;

use App\Models\Secretarias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecretariasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $secretarias = [
            'Secretaría Privada',
            'Secretaría Administrativa',
            'Secretaría de Hacienda',
            'Secretaría de Gobierno',
            'Secretaría de Planeación',
            'Secretaría de Infraestructura',
            'Secretaría de Salud',
            'Secretaría de Educación',
            'Secretaría de Desarrollo Económico y Competitividad',
            'Secretaría de Desarrollo Social y Político',
            'Secretaría de Cultura',
            'Secretaría de Deportes',
            'Secretaría Vivienda Social',
            'Secretaría Jurídica',
            'Secretaría TIC',
            'Secretaría Rural',
        ];

        foreach ($secretarias as $name) {
            Secretarias::create(['name' => $name]);
        }
    }
}
