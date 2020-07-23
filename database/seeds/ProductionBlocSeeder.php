<?php

use Illuminate\Database\Seeder;

class ProductionBlocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ProductionBloc::class, 10)->create();
    }
}
