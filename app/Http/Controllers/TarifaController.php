<?php

namespace App\Http\Controllers;

use App\Models\Tarifa;
use Illuminate\Http\Request;
use App\Http\Requests\TarifaEditRequest;
use App\Http\Requests\TarifaMinutoEditRequest;
Use Alert;

class TarifaController extends Controller
{

    public function update(TarifaEditRequest $request, Tarifa $tarifa)
    {
        try {

            //actualiza la data
            $data = $request->only('valor');

            $tarifa->update($data);

            toast('Registro Actualizado!','success')->timerProgressBar()->autoClose(5000);

            return redirect()->route('estacionamiento.index');
        } catch (\Exception $e){

            //en caso de dar error envia msj
            toast('Error Inesperado!','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back();
        }
    }


    public function minuto(TarifaMinutoEditRequest $request, Tarifa $minuto)
    {
        try {

            //actualiza la data
            $data = $request->only('minuto');

            $minuto->update($data);

            toast('Registro Actualizado!','success')->timerProgressBar()->autoClose(5000);

            return redirect()->route('estacionamiento.index');
        } catch (\Exception $e){

            //en caso de dar error envia msj
            toast('Error Inesperado!','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back();
        }
    }

}
