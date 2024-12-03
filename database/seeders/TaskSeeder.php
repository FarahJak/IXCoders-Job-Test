<?php

namespace Database\Seeders;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Collection::make([
            [
                'title'        => 'Test Title 1',
                'description'  => 'Test Test Test Test Test Test Test Test Test',
                'user_id'      => 1,
                'status'       => TaskStatus::PENDING->value,

            ],
            [
                'title'        => 'Test Title 2',
                'description'  => 'Test Test Test Test Test Test Test Test Test',
                'user_id'      => 1,
                'status'       => TaskStatus::IN_PROGRESS->value,

            ],
            [
                'title'        => 'Test Title 3',
                'description'  => 'Test Test Test Test Test Test Test Test Test',
                'user_id'      => 1,
                'status'       => TaskStatus::COMPLETED->value,

            ]
        ]);

        $tasks->each(function ($task) {
            Task::create($task);
        });
    }
}
