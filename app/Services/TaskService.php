<?php

namespace App\Services;

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
}