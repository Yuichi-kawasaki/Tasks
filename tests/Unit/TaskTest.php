<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Task;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

use Illuminate\Container\Container;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Translation\Translator;
use Illuminate\Translation\ArrayLoader;


class TaskTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $app = new Container;
        $loader = new ArrayLoader();
        $translator = new Translator($loader, 'en');
        $app->singleton(ValidatorFactory::class, function ($app) use ($translator) {
            return new ValidatorFactory($translator, $app);
        });
        $app->alias(ValidatorFactory::class, 'validator');
        Facade::setFacadeApplication($app);
    }
  // タスクが正常にデータベースへ登録されること
    public function test_create_task()
    {
        // タスク作成
        $task = new Task([
            'title' => 'Sample Task',
            'description' => 'This is a sample task for testing.',
            'status' => 'todo',
            'deadline' => '2023-04-08',
        ]);
        //アサーションを使って、タスク保存動作に関する審議の確認。
        $this->assertTrue($task->save());

        // アサーションを使って、タスクがデータベースに正しく作成されているか確認。
        $this->assertDatabaseHas('tasks', [
            'title' => 'Sample Task',
            'description' => 'This is a sample task for testing.',
            'status' => 'todo',
            'deadline' => '2023-04-08',
        ]);
    }
    // タイトルが未入力の場合、タスクのバリデーションが無効であること
    public function test_task_validation_fails_when_title_is_missing()
    {
        $task2 = new Task([
            // 'title' => 'Sample Task',
            'description' => 'This is a sample task for testing2.',
            'status' => 'todo',
        ]);

        // タスクのバリデーションが失敗することを期待します。
        $this->expectException(ValidationException::class);

        $task2->save();
    }

    // ステータスが未入力の場合、タスクのバリデーションが無効であること
    public function test_task_validation_fails_when_status_is_missing()
    {
        $task3 = new Task([
            'title' => 'Sample Task3',
            'description' => 'This is a sample task for testing3.',
            // status属性を設定していない
        ]);

        // タスクのバリデーションが失敗することを期待します。
        $this->expectException(ValidationException::class);

        $task3->save();
    }
}
