<?php

namespace Database\Factories;

use App\Models\Personne;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

class PersonneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personne::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->firstName,
            'prenom' => $this->faker->lastName,
            'sexe' => $this->faker->randomElement([1, 2]),
            'email' => $this->faker->unique()->safeEmail,
            'telephone'  => $this->faker->e164PhoneNumber, 
            'cni' => $this->faker->randomNumber(9), 
            'localisation' => $this->faker->randomElement(['Douala', 'Yaoundé', 'Bafoussam', 'Dchang', 'Limbé']),
            'status' => $this->faker->randomElement([1, 2]),
        ];
    }
}
