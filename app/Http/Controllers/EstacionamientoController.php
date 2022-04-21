<?php

namespace App\Http\Controllers;

use App\Models\Estacionamiento;
use App\Models\Tarifa;
use Illuminate\Http\Request;
use App\Http\Requests\EstacionamientoEditRequest;
Use Alert;


class EstacionamientoController extends Controller
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
        return view('estacionamiento.inicio', compact('estacionamiento', 'tarifa'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estacionamiento  $estacionamiento
     * @return \Illuminate\Http\Response
     */
    public function update(EstacionamientoEditRequest $request, Estacionamiento $estacionamiento)
    {
        try {

            //verifica que la cantidad de estacionamiento a agregra sea superior a los usados
            if($request->input('total')< $estacionamiento->usados){

                toast('El numero de estacionamiento debe ser mayor a los usados!','error')->timerProgressBar()->autoClose(5000);
                return redirect()->back();
            }

            //se resta la cantida de estaconamiento ingresa con la cantidad en uso para conocer la disponibilidad actual
            $disponibles = $request->input('total') - $estacionamiento->usados;

            //actualiza la data
            $data = $request->only('total')
            +[
                'disponibles' => $disponibles,
            ];

            $estacionamiento->update($data);
    
            toast('Registro Actualizado!','success')->timerProgressBar()->autoClose(5000);

            return redirect()->route('estacionamiento.index');
        } catch (\Exception $e){

            //en caso de dar error envia msj
            toast('Error Inesperado!','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back();
        }
    }

}
