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
    return $this->repository->store($data);
  }
}