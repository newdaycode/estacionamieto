<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estacionamiento;

class EstacionamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estacionamiento::create([
    		'total' => '64',
    		'usados' => '0',
    		'disponibles' => '64',
    	]);
    }
}
