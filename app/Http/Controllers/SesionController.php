<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrador;
use App\Profesor;

class SesionController extends Controller
{
    public function generarClave(Request $request)
    {
        $password = $request->contrasena;

        $hash = bcrypt($password);

        return response()->json([
            'password' => $hash
        ], 201);
    }

    public function mostrarClave()
    {
        $resultado = false;

        $password = $request->contrasena;
        $hash = $request->hash;

        if (password_verify($password,$hash)) {
            $resultado = true;
        }

        return response()->json([
            'resultado' => $resultado
        ], 201);
    }
    
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->contrasena;

        $profesor = Profesor::where('email',$email)->first();

        if ($profesor == null) {
            $administrador = Administrador::where('email',$email)->first();
            if ($administrador == null) {
                return response()->json([
                    'error' => 'Usuario no registrado con ese email'
                ], 201);
            }
            else{
                if (password_verify($password,$administrador->contrasena)) {
                    return response()->json([
                        'administrador' => $administrador
                    ], 201);
                }
                else{
                    return response()->json([
                        'error' => 'Contraseña incorrecta'
                    ], 201);
                }
            }
        }
        else{
            if (password_verify($password,$profesor->contrasena)) {
                return response()->json([
                    'profesor' => $profesor
                ], 201);
            }
            else{
                return response()->json([
                    'error' => 'Contraseña incorrecta'
                ], 201);
            }
        }
    }
}
