<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Availability;
use App\Profesor;
use App\Disponibilidad;

class AvailabilityController extends Controller
{
    public function postAvailability(Request $request, $id)
    {
        $profesor = Profesor::find($id);

        $n = count($request->dia);

        if ($n ==0)
        {
            return response()->json([
                'error' => 'No se registró disponibilidad'
            ], 404);
        }

        for ($i=0; $i < $n ; $i++) {
            $disponibilidad = new Disponibilidad();

            $day = $request->dia[$i];
            $hours = implode(',' , $request->horas[$i]);

            $disponibilidad->profesor_id = $id;
            $disponibilidad->dia = $day;
            $disponibilidad->horas = $hours;

            $disponibilidad->save();
        }

        $profesor->permiso = 1;

        $profesor->update();

        return response()->json([
            'mensaje' => 'Disponibilidad registrada'
        ], 201);
    }


    public function putAvailability(Request $request, $id)
    {
        $profesor = Profesor::find($id);

        $validate = $this->validateHours($request->dia, $request->horas, $profesor->categoria->horas_minimas, $profesor->categoria->horas_maximas);

        switch ($validate) {
            case 1:
                return response()->json(['WrongHoursAndDaysNumber' => 'La cantidad de días no concuerda con las horas seleccionadas'], 404);

            case 2:
                return response()->json(['WrongHoursNumber' => 'Debe seleccionar por lo menos 2 horas por día'], 404);

            case 3:
                return response()->json(['WrongHoursNumber' => 'Debe ingresar por lo menos ' . $profesor->categoria->horas_minimas . ' horas'], 404);

            case 4:
                return response()->json(['WrongHoursNumber' => 'Debe ingresar menos de ' . $profesor->categoria->horas_maximas . ' horas'], 404);

            case 5:

                $dispDelete = Disponibilidad::where('profesor_id',$id)->delete();

                $n = count($request->dia);

                for ($i=0; $i < $n ; $i++) {
                    $disponibilidad = new Disponibilidad();

                    $day = $request->dia[$i];
                    $hours = implode(',' , $request->horas[$i]);

                    $disponibilidad->profesor_id = $id;
                    $disponibilidad->dia = $day;
                    $disponibilidad->horas = $hours;

                    $disponibilidad->save();
                }

                $profesor->permiso = 1;

                $profesor->update();

                return response()->json([
                    'mensaje' => 'Disponibilidad actualizada'
                ], 201);
        }
    }

    public function validateHours($days, $hours, $min_hours, $max_hours)
    {
        $totalHours = 0;

        if(count($days) != count($hours))
        {
            return 1; //DIFERENTES
        }

        foreach ($hours as $element) {
            if(count($element) < 2)
            {
                return 2; //MINIMO
            }

            $totalHours += count($element);
        }

        if($totalHours < $min_hours)
        {
            return 3; //MAS
        }

        if($totalHours > $max_hours)
        {
            return 4; //MENOS
        }

        return 5;
    }
}
