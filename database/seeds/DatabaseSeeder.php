<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(GameSeeder::class);
        $this->call(ProductionBlocSeeder::class);
        $this->call(ResourceTypeSeeder::class);
        $this->call(ResourceSeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(RecipeResourceSeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(BuildingRecipeSeeder::class);
        $this->call(ElectricityUniteSeeder::class);
        $this->call(ProductionUniteSeeder::class);
        $this->call(LogSeeder::class);
    }
}
