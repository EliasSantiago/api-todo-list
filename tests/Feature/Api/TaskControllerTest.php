<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_store_with_valid_params()
    {
        $user = User::factory()->create([
            'email' => 'testabc@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->json('POST', '/api/v1/login', [
            'email' => 'testabc@example.com',
            'password' => 'password123',
        ]);

        $token = $response->json('token');

        $taskData = [
            'user_id'       => 1,
            'title'         => 'Planning meeting',
            'description'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status'        => 0,
        ];

        $authenticatedResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/api/v1/tasks', $taskData);

        $authenticatedResponse->assertStatus(201);

        $authenticatedResponse->assertJson([
            'title' => $taskData['title'],
            'description' => $taskData['description'],
        ]);

        $this->assertDatabaseHas('tasks', [
            'title'         => $taskData['title'],
            'description'   => $taskData['description']
        ]);
    }
}
