<?php

namespace App\Repositories\Eloquent;

use App\Models\Task as Model;
use App\Repositories\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
  private $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function store(array $data): object
  {
    return $this->model->create($data);
  }
}