<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Entrenamiento;
use App\Models\Frases;
use App\Models\IMC;
use App\Models\Transformacion;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function login(Request $request)
    {
        //validar ampos
    if (empty($request->input('nombre')) || empty($request->input('password'))) {
        return response()->json(['error' => 'Campos incompletos'], 400);
    }
    //obtener request
    $nombre = $request->input('nombre');
    $password = $request->input('password');

    //consulta
    $user = User::where('nombre', $nombre)->first();
    $user = User::where('password', $password)->first();

    //Si no esta
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }


    //si la contraseña es
    if (!$user->password) {
        return response()->json(['error' => 'Contraseña incorrecta'], 401);
    }

    // Si el usuario existe
    return response()->json(['user' => $user], 200);

    }

    public function registro(Request $request)
    {
        // Asegurarse de que los datos se reciben en la solicitud GET
        if (!$request->has(['nombre', 'password', 'foto'])) {
            return response()->json(['error' => 'Campos incompletos'], 400);
        }

        $nombre = $request->query('nombre');
        $password = $request->query('password');
        $foto = urldecode($request->query('foto')); // Decodificar la URL de la foto

        // Crear una nueva instancia de User y asignar los valores
        $user = new User();
        $user->nombre = $nombre;
        $user->password = Hash::make($password);
        $user->foto = $foto; // Suponiendo que la columna 'foto' existe en la tabla users

        try {
            $user->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar en la base de datos: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }


    public function userIngresado($nombre)
{
    //Realizamos la consulta
    $usuario = User::where('nombre', $nombre)->first();

    //PARA VER LA RESPUESTA EN JSON SI ENCUENTRA EL ID
    if ($usuario) {
        return response()->json(['usuario' => $usuario->id], 200);
    } else {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }
}


    //Metodo para frases
    public function Frases()
    {
        $frases = Frases::All();

        return response()->json(['frases' => $frases], 200);

    }

            // Método para obtener los ejercicios
        public function getEjercicios()
        {
            $ejercicios = Ejercicio::select('id', 'nombre', 'descripcion')->get();

            return response()->json(['ejercicio' => $ejercicios], 200);
        }

    //Este metodo mediante el Id me cuenta cuantos ejercicios tiene el entrenamiento
    public function countEjerciciosPorEntrenamiento($entrenamientoId)
    {
        $count = Ejercicio::where('entrenamientoF', $entrenamientoId)->count();
        return response()->json(['count' => $count], 200);
    }

    //Este metodo obtiene el ID del entrenamiento
    //Lo uso para contar los ejercicios dependiento el entrenamiento
    //EJEMPLO: Principiante-Fuerza(me da el id 1)
    //Ese id lo necesito para el metodo CountEjerciciosPorEntrenamiento
    public function obtenerIDEntrenamiento($nivel, $tipo)
    {
        $entrenamiento = Entrenamiento::where('nivel', $nivel)
            ->where('tipo', $tipo)
            ->distinct()
            ->pluck('id');

        return response()->json(['entrenamiento' => $entrenamiento], 200);
    }


    //METODO PARA GUARDAR EL IMC DEPENDIENDO EL USUARIO

    public function registroIMC(Request $request, $usuarioF)
    {
        // Verificar si el usuario existe
        $user = User::find($usuarioF);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Crear un nuevo registro de IMC
        $imc = new IMC();
        $imc->usuarioF = $user->id;
        $imc->categoriaF = null; // Establecer categoriaF en null
        $imc->altura = $request->input('altura');
        $imc->peso = $request->input('peso');
        $imc->imc = $request->input('imc');
        $imc->save();

        return response()->json(['message' => 'IMC registrado correctamente'], 200);
    }

    //MOSTRAR HISTORIAL DE IMC POR USUARIO INGRESADO
    public function HistorialIMC($idUsuario)
    {
        $historialIMC = IMC::where('usuarioF', $idUsuario)
            ->select('usuarioF', 'altura', 'peso', 'imc', 'created_at')
            ->get();
         return response()->json(['historialIMC' => $historialIMC], 200);

    }

    //optener foto de perfil
    public function obtenerFotoPerfil($nombre)
    {
        $user = User::where('nombre', $nombre)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json(['foto' => $user->foto], 200);
    }

    public function fotoTransformacion(Request $request)
    {
        $usuarioF = $request->query('usuarioF');
        $foto = urldecode($request->query('foto')); // Decodificar la URL de la foto

        // Crear una nueva instancia de User y asignar los valores
        $transformacion = new Transformacion();
        $transformacion->usuarioF = $usuarioF;
        $transformacion->foto = $foto; // Suponiendo que la columna 'foto' existe en la tabla users

        try {
            $transformacion->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar en la base de datos: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }

}

