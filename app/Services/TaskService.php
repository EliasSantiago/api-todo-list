<?php

namespace App\Services;

use App\Exceptions\TaskNotFoundException;
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
    $tasks = $this->repository->index();

    if ($tasks->isEmpty()) {
      throw new TaskNotFoundException('Nenhuma tarefa encontrada.');
    }

    return $tasks;
  }

  public function store(array $data): object
  {
    $data['user_id'] = auth()->id();
    $data['status'] = 'pendente';
    return $this->repository->store($data);
  }

  public function destroy(int $id): bool
  {
    $task = Task::find($id);
    if (!$task) {
      throw new TaskNotFoundException('Nenhuma tarefa encontrada.');
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
