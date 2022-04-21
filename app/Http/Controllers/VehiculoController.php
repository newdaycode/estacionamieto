<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Estacionamiento;
use App\Models\Tarifa;
use App\Models\Caja;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\VehiculoIngresoRequest;
Use Alert;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;


class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estacionamiento = Estacionamiento::first();
        $tarifa = Tarifa::first();
        return view('vehiculos.inicio', compact('estacionamiento', 'tarifa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {

        // return $vehiculo;
        if($vehiculo->estado === 'A'){
            try {

                //actualizar data para registrar hora de salida
                $vehiculo->hora_salida = $request->hora_salida;
                $vehiculo->estado = 'N';
                $vehiculo->valor = $request->monto;
                $vehiculo->save();
    
                //zona horaria de chile
                date_default_timezone_set('America/Santiago');
                
                //fecha de hoy
                $today = Carbon::now()->format('Y-m-d');
    
                $caja = Caja::where('fecha_apertura', '=', $today)
                                    ->where('estado', 'A')->first();
    
                if($caja === null){
    
                    $caja_new = new Caja;
                    $caja_new->fecha_apertura = $today;
                    $caja_new->estado = 'A';
                    $caja_new->valor = $request->monto;
                    $caja_new->save();
    
                }else{
    
                    $caja->valor = $caja->valor + $request->monto;
                    $caja->save();
                }
    
                //consultar estacionamiento para actualizar data
                $estacionamiento = Estacionamiento::first();
                $usados = $estacionamiento->usados - 1;
                $disponible = $estacionamiento->disponibles + 1;
                $estacionamiento->usados = $usados;
                $estacionamiento->disponibles = $disponible;
                $estacionamiento->save();
    
                toast('Salida registrada!','success')->timerProgressBar()->autoClose(5000);

                return redirect()->route('salida.imprimir',[$vehiculo->id]);
    
            } catch (\Exception $e){
                toast('Error Inesperado!','error')->timerProgressBar()->autoClose(5000);
                return redirect()->back();
            }
        }else{
            toast('Ese ticket ya fue cobrado o no existe','error')->timerProgressBar()->autoClose(5000);
                return redirect()->back();
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {

        try {


            $vehiculo->delete();

            //consultar estacionamiento para actualizar data
            $estacionamiento = Estacionamiento::first();
            $usados = $estacionamiento->usados - 1;
            $disponible = $estacionamiento->disponibles + 1;
            $estacionamiento->usados = $usados;
            $estacionamiento->disponibles = $disponible;
            $estacionamiento->save();

            toast('Vehiculo Eliminado','success')->timerProgressBar()->autoClose(5000);
            return redirect()->route('vehiculos.lista');

        } catch (\Exception $e){
            toast('Error Inesperado!','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back();
        }

    }

    public function ticket(VehiculoIngresoRequest $request){

        //zona horaria de chile
        date_default_timezone_set('America/Santiago');
        
        //hora de ingreso
        // $hora_i = Carbon::now()->toTimeString();
        $hora_i = Carbon::now();

        $vehiculo = Vehiculo::where('patente', '=', $request->input('patente'))
                            ->where('estado', 'A')->first();

        //verificamos que el auto no ha ingresado
        if ($vehiculo === null) {
            try {

                $ingreso = Vehiculo::create($request->only('patente')
                +[
                    'hora_ingreso' => $hora_i,
                    'estado' => 'A',
                ]
                );

                //consultar estacionamiento para actualizar data
                $estacionamiento = Estacionamiento::first();
                $usados = $estacionamiento->usados + 1;
                $disponible = $estacionamiento->disponibles - 1;
                $estacionamiento->usados = $usados;
                $estacionamiento->disponibles = $disponible;
                $estacionamiento->save();

                toast('Ingreso Correcto!','success')->timerProgressBar()->autoClose(5000);

                return redirect()->route('ticket.imprimir',[$ingreso->id]);

            } catch (\Exception $e){
                toast('Error Inesperado!','error')->timerProgressBar()->autoClose(5000);
                return redirect()->back();
            }
        }else{
            toast('Este auto ya esta adentro!','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back();
        }

    }


    public function ticket_imprimir(Vehiculo $vehiculo){

        try {

                $nombreImpresora = 'POS-58';
                $connector = new WindowsPrintConnector($nombreImpresora);
                $impresora = new Printer($connector);
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->setEmphasis(true);
                $impresora->text("Estacionamientos o Carro\n");
                $impresora->text("Campos #543 Rancagua\n");
                $impresora->setEmphasis(false);
                $impresora->setEmphasis(false);
                $impresora->text("\n===============================\n");
                $impresora->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
                $impresora->text("Height and bar width\n");
                $impresora->selectPrintMode();
                $heights = array(1, 2, 4, 8, 16, 32);
                $widths = array(1, 2, 3, 4, 5, 6, 7, 8);
                $impresora->text("Default look\n");
                $text = strtoupper($vehiculo->patente);
                $impresora->barcode($text, Printer::BARCODE_CODE39);
                foreach ($heights as $height) {
                    $impresora->text("\nHeight {$height}\n");
                    $impresora->setBarcodeHeight($height);
                    $impresora->barcode($text, Printer::BARCODE_CODE39);
                }
                foreach ($widths as $width) {
                    $impresora->text("\nWidth {$width}\n");
                    $impresora->setBarcodeWidth($width);
                    $impresora->barcode($text, Printer::BARCODE_CODE39);
                }

                $impresora->setEmphasis(false);
                $impresora->text("\n===============================\n");
                $impresora->text("Codigo:");
                $impresora->text($vehiculo->id . "\n");
                $impresora->text("Ingreso: ");
                $impresora->text($vehiculo->hora_ingreso . "\n");
                $impresora->setEmphasis(false);
                $impresora->text("\n===============================\n");
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->text("\n===============================\n");
                $impresora->setJustification(Printer::JUSTIFY_RIGHT);
                $impresora->setEmphasis(true);
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->setTextSize(1, 1);
                $impresora->text("Gracias por venir\n");
                $impresora->text("## Lavados de Autos ##");
                $impresora->feed(5);
                $impresora->cut();
                $impresora->pulse();
                $impresora->close();

                $estacionamiento = Estacionamiento::first();
                $tarifa = Tarifa::first();
                toast('Imprimiendo ticket!','success')->timerProgressBar()->autoClose(5000);
                return view('vehiculos.inicio', compact('estacionamiento', 'tarifa'));

        } catch (Exception $e) {
            toast('No se pudo imprimir!','error')->timerProgressBar()->autoClose(5000);
        }

    }

    public function ticket_salida(Vehiculo $vehiculo){

        try {

                //fecha y hora de salida
                $fecha = Carbon::now();
                $hora_ingreso=Carbon::parse($vehiculo->hora_ingreso);
                $hora_salida=Carbon::parse($vehiculo->hora_salida);

                //minutos trasncurridos entre hora de ingreso y de salida
                $minutos = $hora_ingreso->diffInMinutes($hora_salida);

                $nombreImpresora = 'POS-58';
                $connector = new WindowsPrintConnector($nombreImpresora);
                $impresora = new Printer($connector);
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->setEmphasis(true);
                $impresora->text("Estacionamientos o Carro\n");
                $impresora->text("Campos #543 Rancagua\n");
                $impresora->setEmphasis(false);
                $impresora->setEmphasis(false);
                $impresora->text("\n===============================\n");
                $impresora->text("Ingreso:");
                $impresora->text($vehiculo->hora_ingreso . "\n");
                $impresora->text("Salida: ");
                $impresora->text($vehiculo->hora_salida . "\n");
                $impresora->text("Minutos: ");
                $impresora->text($minutos . "\n");
                $impresora->text("Total: ");
                $impresora->text($vehiculo->valor . "\n");
                $impresora->setEmphasis(false);
                $impresora->text("\n===============================\n");
                $impresora->setJustification(Printer::JUSTIFY_RIGHT);
                $impresora->setEmphasis(true);
                $impresora->setJustification(Printer::JUSTIFY_CENTER);
                $impresora->setTextSize(1, 1);
                $impresora->text("Gracias por venir\n");
                $impresora->text("## Lavados de Autos ##");
                $impresora->feed(5);
                $impresora->cut();
                $impresora->pulse();
                $impresora->close();

                $estacionamiento = Estacionamiento::first();
                $tarifa = Tarifa::first();
                toast('Imprimiendo ticket!','success')->timerProgressBar()->autoClose(5000);
                return view('vehiculos.inicio', compact('estacionamiento', 'tarifa'));

        } catch (Exception $e) {
            toast('No se pudo imprimir!','error')->timerProgressBar()->autoClose(5000);
        }

    }

    public function buscar(Request $request)
    {

        //zona horaria de chile
        date_default_timezone_set('America/Santiago');

        $estacionamiento = Estacionamiento::first();
        $tarifa = Tarifa::first();

        $vehiculo = Vehiculo::where('patente', '=', $request->patente)
                            ->where('estado', 'A')->first();

        //verificamos que el vehiculo alla ingresado al estacionamiento
        if ($vehiculo === null) {

            toast('Ese ticket ya fue cobrado o no existe!','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back();

        }else{

            //fecha y hora de salida
            $fecha = Carbon::now();
            $hora_ingreso=Carbon::parse($vehiculo->hora_ingreso);
            $hora_salida=Carbon::parse($fecha);

            //minutos trasncurridos entre hora de ingreso y de salida
            $minutos = $hora_ingreso->diffInMinutes($hora_salida);

            // Cobro inicial+minutos
            if($minutos>30){

               $monto = (int)$tarifa->valor + (15 * ($minutos - 30));

            } else {
                $monto = (int)$tarifa->valor;
            }

            //estado para activar el botton
            $estado = true;
            return view('vehiculos.inicio', compact('estacionamiento', 'tarifa','vehiculo', 'monto', 'minutos', 'hora_salida', 'estado'));

        }

    }

    
}
