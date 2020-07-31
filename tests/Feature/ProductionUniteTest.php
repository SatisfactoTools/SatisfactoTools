<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ProductionUnite;

class ProductionUniteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test that Production Unite can show one element
     *
     * @return void
     */
    public function test_production_unite_can_show_one()
    {
        $productionUnite = factory(ProductionUnite::class)->create();

        $this->getJson('/api/production_unites/' . $productionUnite->id)
             ->assertStatus(200)
             ->assertJson($productionUnite->toArray());
    }

    /**
     * Test that Production Unite can be created
     *
     * @return void
     */
    public function test_production_unite_can_create()
    {
        $productionUnite = [
            'recipe_id'          => factory(\App\Models\Recipe::class)->create()->id,
            'building_id'        => factory(\App\Models\Building::class)->create()->id,
            'production_bloc_id' => factory(\App\Models\ProductionBloc::class)->create()->id,
            'name' => $this->faker->name
        ];

        $this->postJson('/api/production_unites', $productionUnite)
             ->assertStatus(201)
             ->assertJson($productionUnite);
    }

    // test production unite can be updated
    // test production unite can be deleted
}
