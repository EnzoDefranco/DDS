<?php

namespace Database\Seeders;
use App\Models\OrdenDeAbastecimiento;
use Illuminate\Database\Seeder;

class OrdenDeAbastecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrdenDeAbastecimiento::factory(10)->create();
    }
}
