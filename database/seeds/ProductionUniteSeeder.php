<?php

use Illuminate\Database\Seeder;

class ProductionUniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ProductionUnite::class, 10)->create();
    }
}
