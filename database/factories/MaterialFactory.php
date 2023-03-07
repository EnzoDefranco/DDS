<?php

namespace Database\Factories;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model=Material::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'fechaEmision' => $this->faker->unique->date($format = 'Y-m-d', $max = 'now'),
            // 'plazo' => $this->faker->unique->date($format = 'Y-m-d', $max = 'now')}
            'nombre' => $this->faker->unique->colorName(),
            'codigo' => $this->faker->unique->ean8(),
            'esMateriaPrima' => $this->faker->randomElement([1,0])
        ];
    }
}
