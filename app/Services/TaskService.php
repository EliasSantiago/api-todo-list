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

  public function store(array $data): object
  {
    $data['user_id'] = auth()->id();
    $data['status'] = 0;
    return $this->repository->store($data);
  }

  public function destroy(int $id): bool
  {
    $task = Task::find($id);

    if (!$task) {
        throw new \Exception("Task not found", 404);
    }

    return $this->repository->destroy($id);
  }
}