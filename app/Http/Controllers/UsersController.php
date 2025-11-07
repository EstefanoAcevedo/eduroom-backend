<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all()->map(function ($user) {
            return [
                "user_id" => $user->user_id,
                "user_email" => $user->user_email,
                "user_lastname" => $user->user_lastname,
                "user_name" => $user->user_name,
                "user_cuil" => $user->user_cuil,
                "user_tel" => $user->user_tel,
                "user_address" => $user->user_address,
                "user_location" => $user->user_location,
                "updated_at" => $user->updated_at,
                "created_at" => $user->created_at,
                "roles" => $user->getRoleNames(),
            ];
        });
        return response()->json($users, 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudieron obtener los usuarios',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'user' => [
                    "user_id" => $user->user_id,
                    "user_email" => $user->user_email,
                    "user_lastname" => $user->user_lastname,
                    "user_name" => $user->user_name,
                    "user_cuil" => $user->user_cuil,
                    "user_tel" => $user->user_tel,
                    "user_address" => $user->user_address,
                    "user_location" => $user->user_location,
                    "updated_at" => $user->updated_at,
                    "created_at" => $user->created_at,
                    "roles" => $user->getRoleNames(),
                ],
            ], 200);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'El usuario solicitado no existe'
            ], 404);
            
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo obtener el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'user_cuil' => 'string|required|max:11|unique:users,user_cuil',
                'user_email' => 'string|required|max:255|unique:users,user_email',
                'user_lastname' => 'string|required|max:255',
                'user_name' => 'string|required|max:255',
                'user_tel' => 'string|required|max:15',
                'user_address' => 'string|required|max:255',
                'user_location' => 'string|required|max:255',
                'rol' => 'required|in:Admin,Teacher,Student',
            ]);
            $user = User::findOrFail($id);
            $user->update($request->all());
            return response()->json([
                'message' => 'Usuario actualizado exitosamente',
                'user' => [
                    "user_id" => $user->user_id,
                    "user_email" => $user->user_email,
                    "user_lastname" => $user->user_lastname,
                    "user_name" => $user->user_name,
                    "user_cuil" => $user->user_cuil,
                    "user_tel" => $user->user_tel,
                    "user_address" => $user->user_address,
                    "user_location" => $user->user_location,
                    "updated_at" => $user->updated_at,
                    "created_at" => $user->created_at,
                    "roles" => $user->getRoleNames(),
                ],
            ], 200);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo actualizar el usuario, verifique la validez de los datos',
                'error' => $e->validator->errors()
            ], 422);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'El usuario solicitado no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo actualizar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'message' => 'Usuario eliminado exitosamente',
                'user' => [
                    "user_id" => $user->user_id,
                    "user_email" => $user->user_email,
                    "user_lastname" => $user->user_lastname,
                    "user_name" => $user->user_name,
                    "user_cuil" => $user->user_cuil,
                    "user_tel" => $user->user_tel,
                    "user_address" => $user->user_address,
                    "user_location" => $user->user_location,
                    "updated_at" => $user->updated_at,
                    "created_at" => $user->created_at,
                    "roles" => $user->getRoleNames(),
                ],
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'El usuario solicitado no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo eliminar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
