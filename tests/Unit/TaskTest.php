<?php

namespace Tests\Unit;

use App\Models\Task;
use Tests\TestCase;
use Illuminate\Validation\ValidationException;

class TestTask extends Task
{
    protected function getValidationRules()
    {
        return [];
    }
}

class TaskTest extends TestCase
{
    public function test_create_task()
    {
        // タスク作成
        $task = new TestTask([
            'title' => 'Sample Task',
            'description' => 'This is a sample task for testing.',
            'status' => 'todo',
            'deadline' => '2023-04-08',
        ]);

        // タスクを保存し、成功したことを確認します
        $this->assertTrue($task->save());
        // アサーションを使って、タスクがデータベースに正しく作成されているか確認。
        $this->assertDatabaseHas('test_tasks', [
            'title' => 'Sample Task',
            'description' => 'This is a sample task for testing.',
            'status' => 'todo',
            'deadline' => '2023-04-08',
        ]);
    }

    // 既存のテストメソッド

    public function test_task_validation_fails_when_title_is_missing()
    {
        $task = new Task([
            'description' => 'This is a sample task for testing.',
            'status' => 'todo',
        ]);

        // タスクのバリデーションが失敗することを期待しています。
        $this->expectException(ValidationException::class);

        $task->validate();
    }

    public function test_task_validation_fails_when_status_is_missing()
    {
        $task = new Task([
            'title' => 'Sample Task',
            // 'description' => 'This is a sample task for testing.',
            // status属性を設定していない
            // 'status' => 'todo',
        ]);

        // タスクのバリデーションが失敗することを期待しています。
        $this->expectException(ValidationException::class);

        $task->validate();
    }
}
