<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SetsJsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteTask;
use App\Http\Requests\StoreTask;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use SetsJsonResponse;

    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTask $request)
    {
        try {
            $validated = $request->validated();
            $task = $this->service->store($validated);
            return $this->setJsonResponse($task, 201);
        } catch (\Exception $e) {
            return $this->setJsonResponse([
                'message' => $e->getMessage(),
                'error'   => true
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if (!is_numeric($id)) {
                $error = [
                    'message' => 'O campo ID deve ser um número',
                    'error'   => 'true'
                ];
                return $this->setJsonResponse($error, 422);
            }

            $this->service->destroy($id);
            return response()->noContent();
        } catch (\Exception $e) {
            return $this->setJsonResponse([
                'message' => $e->getMessage(),
                'error'   => true
            ], 500);
        }
    }
}
