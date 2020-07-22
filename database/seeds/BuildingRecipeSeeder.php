<?php

use Illuminate\Database\Seeder;

class BuildingRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BuildingRecipe::class, 5)->create();
    }
}
