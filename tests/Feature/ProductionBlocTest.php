<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ProductionBloc;

class ProductionBlocTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test that production bloc can list
     *
     * @return void
     */
    public function test_production_bloc_can_list()
    {
        $productionBlocs = factory(ProductionBloc::class, 3)->create();

        $this->getJson('/api/production_blocs')
             ->assertStatus(200)
             ->assertJson($productionBlocs->toArray());
    }

    /**
     * Test that production bloc can show one 
     *
     * @return void
     */
    public function test_production_bloc_can_show_one()
    {
        $productionBloc = factory(ProductionBloc::class)->create();

        $this->getJson('/api/production_blocs/' .$productionBloc->id)
             ->assertStatus(200)
             ->assertJson($productionBloc->toArray());
    }

    /**
     * Test that production bloc can be created
     *
     * @return void
     */
    public function test_production_bloc_can_create()
    {
        $game = factory(\App\Models\Game::class)->create();

        $productionBloc = [
            'game_id' => $game->id,
            'name' => $this->faker->name
        ];

        $this->postJson('/api/production_blocs', $productionBloc)
             ->assertStatus(201)
             ->assertJson($productionBloc);
    }

    /**
     * Test that production bloc can send error when given a wrong game id
     *
     * @return void
     */
    public function test_production_bloc_can_send_error_with_wrong_game_id()
    {
        $productionBloc = [
            'game_id' => 5,
            'name' => $this->faker->name
        ];

        $this->postJson('/api/production_blocs', $productionBloc)
             ->assertStatus(404)
             ->assertJson(['message' => "Game not found"]);
    }

    // Test modif bloc
    // Test suppression bloc
    // Test game existe pas pendant modif bloc
}
