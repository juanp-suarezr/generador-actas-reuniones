<?php

namespace Database\Seeders;

use App\Models\Corregimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorregimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $corregimientos = [
            'Corregimiento 1',
            'Corregimiento 2',
            'Corregimiento 3',
            // Add more
        ];

        foreach ($corregimientos as $name) {
            Corregimiento::create(['name' => $name]);
        }
    }
}
