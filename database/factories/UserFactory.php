<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition(): array
    {
        return [
            'number_id'=> $this->faker->randomNumber(9,false),
            'name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'address'=> $this->faker->address(),
            'cellphone'=>$this->faker->phoneNumber(),
            'email'=>$this->faker->unique()->safeEmail(),
            'password'=>bcrypt(12345678),
        ];
    }
}
