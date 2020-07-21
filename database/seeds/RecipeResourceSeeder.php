<?php

use Illuminate\Database\Seeder;

class RecipeResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\RecipeResource::class, 10)->create();
    }
}
