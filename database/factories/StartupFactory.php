<?php

namespace Database\Factories;

use App\Models\Startup;
use Illuminate\Database\Eloquent\Factories\Factory;

class StartupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Startup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'startup_name' => 'test startup name',
            'user_id' => 1,
            'city_id' => 1,
            'startup_logo' => '0gqXSv5bHQP8eaV7ePgcuZLEd9RE6ckp76DPwFxn.png'
        ];
    }
}
