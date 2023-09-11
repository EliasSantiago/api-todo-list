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

  public function index(): object
  {
    return $this->model->paginate(20);
  }

  public function store(array $data): object
  {
    return $this->model->create($data);
  }

  public function destroy(int $id): bool
  {
    return $this->model->destroy($id) > 0;
  }

  public function show(int $id): object | null 
  {
    return $this->model->find($id);
  }

  public function update(int $id, array $data): object | null
  {
    $task = $this->model->find($id);
    $task->update($data);
    return $task;
  }
}