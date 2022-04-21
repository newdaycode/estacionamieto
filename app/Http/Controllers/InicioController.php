<?php

namespace App\Http\Controllers;

use App\Models\Estacionamiento;
use App\Models\Tarifa;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){

        $estacionamiento = Estacionamiento::first();
        $tarifa = Tarifa::first();
        return view('welcome', compact('estacionamiento', 'tarifa'));
    }
}
