<?php

namespace App\Repositories\Eloquent;

use App\Models\User as Model;
use App\Repositories\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
  private $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function register(array $data): ?object
  {
    return $this->model->create($data);
  }

  public function login(array $data): ?object
  {
    $user = $this->model->where('email', $data['email'])->first();
    if (!$user) {
      return null;
    }

    if (!Hash::check($data['password'], $user->password)) {
      return null;
    }

    $user->tokens()->delete();
    
    $tokenResult = $user->createToken('api-todo');
    $user['token_type'] = 'Bearer';
    $user['token'] = $tokenResult->accessToken;

    return $user;
  }
}