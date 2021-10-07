<?php

namespace Database\Factories;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaskList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->text(25),
            'starred' => $this->faker->boolean
        ];
    }
}
