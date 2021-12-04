<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'brand' => $this->faker->word(),
            'price' => $this->faker->randomDigit(),
            'created_at'=>$this->faker->dateTimeBetween(),
            'updated_at' => \Carbon\Carbon::yesterday()
        ];
    }
}
