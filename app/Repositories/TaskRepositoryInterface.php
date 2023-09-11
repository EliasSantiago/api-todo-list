<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
  public function index(): object;
  public function store(array $data): object;
  public function destroy(int $id): bool;
  public function show(int $id): object | null;
  public function update(int $id, array $data): object | null;
}