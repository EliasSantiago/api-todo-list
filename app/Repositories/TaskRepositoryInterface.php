<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
  public function store(array $data): object;
  public function destroy(int $id): bool;
  public function show(int $id): object | null;
}