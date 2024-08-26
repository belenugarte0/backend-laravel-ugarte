<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        if ($user->status == 0) {
            return response()->json(['error' => 'EL USUARIO ESTA INACTIVO'], 403);
        }
        Log::create([
            'id_user' => $user->id,
            'evento' => 'Inicio de sesión',
            'ip' => $request->ip(),
            'detalle' => $request->header('User-Agent')
        ]);

        return $this->respondWithToken($token, $user);
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token

        ]);
    }

    public function logout(Request $request)
    {
        // Registro del evento de cierre de sesión
        Log::create([
            'id_user' => Auth::user()->id,
            'evento' => 'Cierre de sesión',
            'ip' => $request->ip(),
            'detalle' => $request->header('User-Agent')
        ]);
        auth()->logout();


        return response()->json([
            "message" => "La sesion se cerro correctamente",
        ]);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function checkToken(Request $request)
    {
        $user = $request->user();
        return response()->json([
            "user" => new UserResource($user),
        ]);
    }
    public function profile()
    {
        $user = auth()->user();

        return response()->json([
            'profiles' => [
                [
                    'id' => $user->id,
                    'name' => $user->name,
                    'lastname' => $user->lastname,
                    'document' => $user->document,
                    'email' => $user->email,
                    'image' => $user->image,
                    'createdAt' => $user->created_at
                ]
            ]
        ]);
    }
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

         if (!$user) {
            return response()->json([
                "message" => "No se encontró el Usuario",
            ], 404);
        }

        $rules = [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'password' => 'nullable|min:8|confirmed', 
            'image' => 'nullable|url', 
        ];

        $messages = [
            'email.required' => 'El correo electrónico es requerido',
            'email.email' => 'El correo electrónico debe tener un formato válido',
            'email.unique' => 'El correo electrónico ya está en uso',
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'lastname.required' => 'El apellido es requerido',
            'lastname.min' => 'El apellido debe tener al menos 3 caracteres',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'La confirmación de la contraseña no coincide',
            'image.url' => 'La URL de la imagen no es válida',
        ];

        // VALIDAR DATOS
        $validatedData = $request->validate($rules, $messages);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // Si la contraseña no se proporciona, eliminarla de los datos validados para no sobrescribirla
            unset($validatedData['password']);
        }

        // ACTUALIZAR EL USUARIO
        $user->update($validatedData);

        
        return response()->json([
            "message" => "EL USUARIO FUE ACTUALIZADO!",
            "user" => new UserResource($user),
        ], 200);
    }
}
