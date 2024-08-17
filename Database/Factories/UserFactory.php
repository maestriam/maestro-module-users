<?php
namespace Maestro\Users\Database\Factories;

use Illuminate\Support\Facades\Hash;
use Maestro\Users\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define os dados que serão criados como 
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'email'      => $this->faker->email(),
            'password'   => Hash::make($this->faker->password())
        ];
    }
}

