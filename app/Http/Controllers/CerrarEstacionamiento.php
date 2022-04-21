<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Caja;
use App\Models\Estacionamiento;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class CerrarEstacionamiento extends Controller
{
    public function index(){

        try {

            $vehiculos = Vehiculo::where('estado', 'A')->get();


            if(!$vehiculos->isEmpty()){

                toast('Aun hay vehiculos en el estacionamiento!','error')->timerProgressBar()->autoClose(5000);
                return redirect()->back();
            }
            
            //consultar estacionamiento para actualizar data
            $estacionamiento = Estacionamiento::first();
            $estacionamiento->usados = 0;
            $estacionamiento->disponibles = 0;
            $estacionamiento->save();

            //zona horaria de chile
            date_default_timezone_set('America/Santiago');
            
            //fecha de hoy
            $today = Carbon::now()->format('Y-m-d');

            $caja = Caja::where('fecha_apertura', '=', $today)
                                ->where('estado', 'A')->first();

            // verifica si la caja no ha sido iniciada, se inicia en automatico cuanto se ingresa la hora de salida de un vehiculo
            if($caja != null){

                $caja->estado = 'C';
                $caja->save();
    
            }

            toast('Cierre Exitoso!','success')->timerProgressBar()->autoClose(5000);

            return redirect()->route('inicio');

        } catch (\Exception $e){
            toast('Error Inesperado!','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back();
        }

    }
}
