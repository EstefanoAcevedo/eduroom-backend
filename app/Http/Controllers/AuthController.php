<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
    * Register a new user.
    */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'user_cuil' => 'string|required|max:11|unique:users,user_cuil',
                'user_email' => 'string|required|max:255|unique:users,user_email',
                'user_pass' => 'string|required|max:255',
                'user_lastname' => 'string|required|max:255',
                'user_name' => 'string|required|max:255',
                'user_tel' => 'string|required|max:15',
                'user_address' => 'string|required|max:255',
                'user_location' => 'string|required|max:255',
                'rol' => 'required|in:Admin,Teacher,Student',
            ]);
            $user = User::create([
                'user_cuil' => $request->user_cuil,
                'user_email' => $request->user_email,
                'user_pass' => Hash::make($request->user_pass),
                'user_lastname' => $request->user_lastname,
                'user_name' => $request->user_name,
                'user_tel' => $request->user_tel,
                'user_address' => $request->user_address,
                'user_location' => $request->user_location,
            ]);
            $user->assignRole($request->rol);
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Usuario registrado exitosamente',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    "user_cuil" => $user->user_cuil,
                    "user_email" => $user->user_email,
                    "user_lastname" => $user->user_lastname,
                    "user_name" => $user->user_name,
                    "user_tel" => $user->user_tel,
                    "user_address" => $user->user_address,
                    "user_location" => $user->user_location,
                    "updated_at" => $user->updated_at,
                    "created_at" => $user->created_at,
                    "user_id" => $user->user_id,
                    "roles" => $user->getRoleNames(),
                ],
            ], 201);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo registrar el usuario, verifique la validez de los datos enviados',
                'errors' => $e->errors()
            ], 422);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo registrar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
    * Authenticate a user and generate a token.
    */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'user_email' => 'string|required|max:255',
                'user_pass' => 'string|required|max:255',
            ]);
            $user = User::where('user_email', $request->user_email)->first();
            if (! $user || ! Hash::check($request->user_pass, $user->user_pass)) {
                return response()->json([
                    'message' => 'Credenciales inválidas',
                ], 401);
            }
            $user->tokens()->delete();  // Revoke old tokens to ensure only one active token per login for simplicity
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    "user_cuil" => $user->user_cuil,
                    "user_email" => $user->user_email,
                    "user_lastname" => $user->user_lastname,
                    "user_name" => $user->user_name,
                    "user_tel" => $user->user_tel,
                    "user_address" => $user->user_address,
                    "user_location" => $user->user_location,
                    "updated_at" => $user->updated_at,
                    "created_at" => $user->created_at,
                    "user_id" => $user->user_id,
                    "roles" => $user->getRoleNames(),
                ],
            ]);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo iniciar sesión, verifique la validez de los datos enviados',
                'errors' => $e->errors()
            ], 422);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo iniciar sesión',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
    * Log out the authenticated user (revoke current token).
    */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Sesión cerrada exitosamente']);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo cerrar sesión',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}