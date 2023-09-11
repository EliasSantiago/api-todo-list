<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepositoryInterface;

class TaskService
{
  private $repository;

  public function __construct(TaskRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function index(): object
  {
    return $this->repository->index();
  }

  public function store(array $data): object
  {
    $data['user_id'] = auth()->id();
    return $this->repository->store($data);
  }

  public function destroy(int $id): bool
  {
    $task = Task::find($id);
    if (!$task) {
      throw new \Exception("Tarefa não encontrada", 404);
    }
    return $this->repository->destroy($id);
  }

  public function show(int $id): object | null
  {
    $task = $this->repository->show($id);
    if (!$task) {
      throw new \Exception("Tarefa não encontrada", 404);
    }
    return $task;
  }

  public function update(int $id, array $data): object | null
  {
    $task = Task::find($id);
    if (!$task) {
      throw new \Exception("Tarefa não encontrada", 404);
    }
    return $this->repository->update($id, $data);
  }
}
