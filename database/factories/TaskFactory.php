<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_list_id' => TaskList::all()->random()->id,
            'name' => $this->faker->text(15),
            'completed' => $this->faker->boolean,
            'starred' => $this->faker->boolean
        ];
    }
}
