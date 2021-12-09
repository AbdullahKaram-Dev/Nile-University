<?php

namespace Database\Factories;

use App\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Deal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'startup_id' => 1,
            'deal_name' => ['en'=>'name english','ar'=>'الاسم عربى'],
            'deal_description' => ['en'=>'description english','ar'=>'الوصف عربى'],
            'deal_value' => '1000 EGP',
            'deal_logo' => '0gqXSv5bHQP8eaV7ePgcuZLEd9RE6ckp76DPwFxn.png'
        ];
    }
}
