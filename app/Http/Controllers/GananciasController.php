<?php

namespace App\Http\Controllers;

use App\Models\Estacionamiento;
use App\Models\Tarifa;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class GananciasController extends Controller
{
    public function ganancias(){


        $ganancias = Vehiculo::where('estado', 'N')->get();
        $estacionamiento = Estacionamiento::first();
        $tarifa = Tarifa::first();
        
        return view('ganancias.listado', compact('ganancias', 'estacionamiento', 'tarifa'));
    }
}
