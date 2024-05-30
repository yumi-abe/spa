<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

use function PHPUnit\Framework\assertJson;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function 一覧を取得()
    {
        $tasks = Task::factory()->count(10)->create();

        $response = $this->getJson('api/tasks');

        $response
            ->assertOk()
            ->assertJsonCount($tasks->count());

    }

    /**
     *
     * @test
     */
    public function 登録することができる()
    {
        $data = [
            'title' => 'テスト投稿'
        ];

        $response = $this->postJson('api/tasks', $data);

        // dd($response->json());

        $response
            ->assertCreated()
            ->assertJsonFragment($data);

    }

}
