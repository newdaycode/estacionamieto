<?php

namespace App\Http\Controllers;

use App\Models\Estacionamiento;
use App\Models\Tarifa;
use App\Models\Caja;
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Carbon\Carbon;

class CajaController extends Controller
{
    public function listado(){

        $cajas = Caja::get();
        $estacionamiento = Estacionamiento::first();
        $tarifa = Tarifa::first();
        
        return view('caja.listado', compact('cajas', 'estacionamiento', 'tarifa'));
    }

    public function cierre(){

        // try {

            //zona horaria de chile
            date_default_timezone_set('America/Santiago');
            
            //fecha de hoy
            $today = Carbon::now()->format('Y-m-d');

            $caja = Caja::where('fecha_apertura', '=', $today)
                                ->where('estado', 'A')->first();

            // verifica si la caja no ha sido iniciada, se inicia en automatico cuanto se ingresa la hora de salida de un vehiculo
            if($caja === null){

                toast('La caja aun esta cerrada, ingresa la salida de un vehiculo!','error')->timerProgressBar()->autoClose(5000);
                return redirect()->route('vehiculo.index');
    
            }else{
    
                $caja->estado = 'C';
                $caja->save();

                $nombreImpresora = 'POS-58';
                $connector = new WindowsPrintConnector($nombreImpresora);
                $impresora = new Printer($connector);
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->setEmphasis(true);
                $impresora->text("Estacionamientos o Carro\n");
                $impresora->setEmphasis(false);
                $impresora->text("\n===============================\n");
                $impresora->text("Cierre diario:");
                $impresora->text($today . "\n");
                $impresora->text("Total: ");
                $impresora->text($caja->valor . "\n");
                $impresora->setEmphasis(false);
                $impresora->text("\n===============================\n");
                $impresora->feed(5);
                $impresora->cut();
                $impresora->pulse();
                $impresora->close();

                $estacionamiento = Estacionamiento::first();
                $tarifa = Tarifa::first();
                toast('Caja Cerrada!','success')->timerProgressBar()->autoClose(5000);
                return view('vehiculos.inicio', compact('estacionamiento', 'tarifa'));

            }

        // } catch (\Exception $e){
        //     toast('Error Inesperado!','error')->timerProgressBar()->autoClose(5000);
        //     return redirect()->back();
        // }

    }




}
