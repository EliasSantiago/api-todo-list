<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SetsJsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use App\Http\Requests\RegisterUser;
use App\Services\AuthService;
use Illuminate\Auth\AuthenticationException;

class AuthController extends Controller
{
    use SetsJsonResponse;

    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterUser $request)
    {
        try {
            $validated = $request->validated();
            $validated['password'] = bcrypt($validated['password']);
            $user = $this->service->register($validated);
            return $this->setJsonResponse($user, 201);
        } catch (\Exception $e) {
            return $this->setJsonResponse([
                'message' => $e->getMessage(),
                'error'   => true
            ], 500);
        }
    }

    public function login(LoginUser $request)
    {
        try {
            $data = $request->validated();
            $user = $this->service->login($data);
            return $this->setJsonResponse($user);
        } catch (AuthenticationException $e) {
            return $this->setJsonResponse([
                'message' => $e->getMessage(),
                'error'   => true
            ], 401);
        } catch (\Exception $e) {
            return $this->setJsonResponse([
                'message' => $e->getMessage(),
                'error'   => true
            ], 500);
        }
    }

    public function me()
    {
        try {
            return $this->setJsonResponse($this->service->me());
        } catch (\Throwable $th) {
            return $this->setJsonResponse([
                'message' => $th->getMessage(),
                'error'   => true
            ], 500);
        }
    }
}
