<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permiso;
use App\Profesor;

class PermissionController extends Controller
{
    public function requestPermission(Request $request, $id)
    {
        $profesor = Profesor::find($id);
        
        if($profesor->permiso == 1)
        {
            return response()->json([
                'NotAllowed' => 'El usuario ya tiene permiso para editar.'
                 ], 400);
        }

        $permiso = Permiso::where('profesor_id',$id)->where('estado','-')->first();

        if ($permiso != null)
        {
            if($permiso->estado == '-')
            {
                return response()->json([
                    'NotAllowed' => 'El usuario ya tiene permiso para editar.'
                     ], 400);
            }
        }

        $permiso2 = new Permiso();

        $permiso2->profesor_id = $id;
        $permiso2->solicitud = $request->solicitud;
        $permiso2->motivo = '';

        $permiso2->save();

        return response()->json([
            'mensaje' => 'Solicitud enviada.'
             ], 201);

    }

    public function approvePermission(Request $request, $id, $idSolicitud)
    {
        $profesor = Profesor::find($id);

        $permiso = Permiso::find($idSolicitud);

        if($permiso->estado != '-')
        {
            return response()->json([
                'NotAllowed' => 'La solicitud ya ha sido evaluada.'
                 ], 400);
        }

        switch ($request->estado) {
            case 'APROBADO':
                $permiso->estado = 'APROBADO';
                $permiso->update();

                $profesor->permiso = 1;
                $profesor->update();

                return response()->json([
                    'mensaje' => 'La solicitud fue aprobada.'
                     ], 201);

            case 'RECHAZADO':
                $permiso->estado = 'RECHAZADO';
                $permiso->motivo = $request->motivo;
                $permiso->update();

                return response()->json([
                    'mensaje' => 'La solicitud fue rechazada.'
                     ], 201);
            
            default:
                return response()->json([
                    'StatusNotAllowed' => 'Ingrese un estado valido.'
                    ], 400);
        }
    }
}
