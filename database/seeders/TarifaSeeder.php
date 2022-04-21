<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarifa;

class TarifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarifa::create([
    		'descripcion' => 'Estacionamiento',
    		'valor' => '500',
    		'minuto' => '20',
    	]);
    }
}
