<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\UserRepository;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Traits\UtilResponse;

class UserController extends Controller
{
    private $utilResponse;
    private $userRepository;

    public function __construct(UtilResponse $utilResponse, UserRepository $userRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(UserResource::collection($this->userRepository->getAll()),'Proveedores obtenidos correctamente');
    }

    public function storeUser(StoreUserRequest $request)
    {
        try {
            $user = $this->userRepository->create($request->validated());
            return $this->utilResponse->succesResponse(new UserResource($user), 'Usuario creado con éxito', 201);
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse('Error al crear el usuario: ' . $e->getMessage(), 500);
        }
    }

    public function oneUser($id)
    {
        try {
            $user = $this->userRepository->findById($id);
            if (!$user) {
                return $this->utilResponse->errorResponse('Usuario no encontrado', 404);
            }
            return $this->utilResponse->succesResponse(new UserResource($user), 'Usuario encontrado');
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse('Error al obtener el usuario: ' . $e->getMessage(), 500);
        }
    }

    public function updateUser($id, UpdateUserRequest $request)
    {
        try {
            $user = $this->userRepository->update($id, $request->validated());
            if (!$user) {
                return $this->utilResponse->errorResponse('Usuario no encontrado', 404);
            }
            return $this->utilResponse->succesResponse(new UserResource($user), 'Usuario actualizado con éxito');
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse('Error al actualizar el usuario: ' . $e->getMessage(), 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $result = $this->userRepository->delete($id);
            if (!$result) {
                return $this->utilResponse->errorResponse('Usuario no encontrado', 404);
            }
            return $this->utilResponse->succesResponse(null, 'Usuario eliminado con éxito');
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse('Error al eliminar el usuario: ' . $e->getMessage(), 500);
        }
    }
}
