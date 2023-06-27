<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'category_id'=>$this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'name' => $this->faker->word(),
            'price'=> $this->faker->randomNumber(5,true),
            'stock'=> $this->faker->randomNumber(2,true),
            'description' =>$this->faker->paragraph(),
        ];
    }
}
