<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use Facade\Ignition\Tabs\Tab;

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
    public function 登録()
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

        /**
     *
     * @test
     */
    public function タイトルが空の場合登録できない()
    {
        $data = [
            'title' => ''
        ];

        $response = $this->postJson('api/tasks', $data);

        // dd($response->json());

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => '件名は必ず指定してください。'
            ]);

    }

        /**
     *
     * @test
     */
    public function タイトルが255文字の場合は登録できない()
    {
        $data = [
            'title' => str_repeat('あ', 256)
        ];

        $response = $this->postJson('api/tasks', $data);

        // dd($response->json());

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => '件名は、255文字以下で指定してください。'
            ]);

    }

        /**
     *
     * @test
     */
    public function 更新()
    {
        $task = Task::factory()->create();

        $task->title = '書き換え';

        // dd($task);
        $response = $this->patchJson("api/tasks/{$task->id}", $task->toArray());
        // dd($response->json());

        $response
            ->assertOk()
            ->assertJsonFragment($task->toArray());

    }

            /**
     *
     * @test
     */
    public function 削除()
    {
        $tasks = Task::factory()->count(10)->create();

        $response = $this->deleteJson("api/tasks/1");

        $response->assertOk();

        $response = $this->getJson("api/tasks");
        $response->assertJsonCount($tasks->count() -1);
        

        // $response
        //     ->assertOk()
        //     ->assertJsonFragment($task->toArray());

    }

    
}
