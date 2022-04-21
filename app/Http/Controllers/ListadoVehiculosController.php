<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Estacionamiento;
use App\Models\Tarifa;
use Illuminate\Http\Request;
Use Alert;

class ListadoVehiculosController extends Controller
{
    public function lista(){
        $vehiculos = Vehiculo::where('estado', 'A')->get();
        $estacionamiento = Estacionamiento::first();
        $tarifa = Tarifa::first();
        
        return view('vehiculos.listado', compact('vehiculos', 'estacionamiento', 'tarifa'));
    }

    public function borrados(){

        $vehiculos = Vehiculo::onlyTrashed()->get();
        $estacionamiento = Estacionamiento::first();
        $tarifa = Tarifa::first();
        
        return view('vehiculos.borrados', compact('vehiculos', 'estacionamiento', 'tarifa'));
    }


}
