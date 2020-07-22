<?php

use Illuminate\Database\Seeder;

class ElectricityUniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ElectricityUnite::class, 5)->create();
    }
}
