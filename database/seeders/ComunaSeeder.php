<?php

namespace Database\Seeders;

use App\Models\Comuna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comunas = [
            'Comuna 1',
            'Comuna 2',
            'Comuna 3',
            'Comuna 4',
            'Comuna 5',
            // Add more as needed
        ];

        foreach ($comunas as $name) {
            Comuna::create(['name' => $name]);
        }
    }
}
