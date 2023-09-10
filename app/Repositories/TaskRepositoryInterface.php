<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
  public function store(array $data): object;
}