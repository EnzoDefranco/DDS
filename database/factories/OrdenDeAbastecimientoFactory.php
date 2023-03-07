<?php

namespace Database\Factories;
use App\Models\OrdenDeAbastecimiento;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdenDeAbastecimientoFactory extends Factory
{
    protected $model=OrdenDeAbastecimiento::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'nombre' => $this->faker->unique->colorName(),
            // 'codigo' => $this->faker->unique->ean8(),
            // 'esMateriaPrima' => $this->faker->randomElement([1,0])
            'fechaEmision' => $this->faker->unique->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'plazo' => $this->faker->unique->dateTimeBetween($startDate = 'now', $endDate = '+40 days', $timezone = null)
        ];
    }
}
