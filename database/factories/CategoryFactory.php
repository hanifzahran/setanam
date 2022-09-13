<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    $factory->define(Category::class, function (Faker $faker)) {
        return [
            'name'          =>  $faker->name,
            'description'   =>  $faker->realText(100),
            'parent_id'     =>  1,
            'menu'          =>  1,
        ];
    }
    
    public function definition()
    {
        return [
            //
        ];
    }


}
