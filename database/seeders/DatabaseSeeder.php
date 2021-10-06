<?php

namespace Database\Seeders;

use App\Models\TaskList;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TaskList::factory(3)->create();
        Task::factory(12)->create();
    }
}
