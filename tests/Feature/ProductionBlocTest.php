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
    public function test_production_bloc_can_send_error_with_wrong_game_id_when_create()
    {
        $productionBloc = [
            'game_id' => 5,
            'name' => $this->faker->name
        ];

        $this->postJson('/api/production_blocs', $productionBloc)
             ->assertStatus(404)
             ->assertJson(['message' => "Game not found"]);
    }

    /**
     * Test that production can be updated
     *
     * @return void
     */
    public function test_production_bloc_can_update()
    {
        $productionBloc_before_update = factory(ProductionBloc::class)->create();

        $productionBloc_update_data = [
            'game_id' => factory(\App\Models\Game::class)->create()->id,
            'name' => $this->faker->name
        ];

        // Assert that production bloc return a confirmation message
        $this->putJson('/api/production_blocs/' .$productionBloc_before_update->id, $productionBloc_update_data)
             ->assertStatus(200)
             ->assertJson(['message' => "Production bloc successfully updated"]);

        // Assert that production bloc is correctly updated
        $this->getJson('/api/production_blocs/' .$productionBloc_before_update->id)
             ->assertStatus(200)
             ->assertJson($productionBloc_update_data);
    }

    /**
     * Test that production bloc can send a error when given wrong game id
     *
     * @return void
     */
    public function test_production_bloc_can_send_error_with_wrong_game_id_when_update()
    {
        $productionBloc_before_update = factory(ProductionBloc::class)->create();

        $productionBloc_update_data = [
            'game_id' => 5,
            'name' => $this->faker->name
        ];

        // Assert that production bloc return a error message
        $this->putJson('/api/production_blocs/' .$productionBloc_before_update->id, $productionBloc_update_data)
             ->assertStatus(404)
             ->assertJson(['message' => "Game not found"]);

        // Assert that production bloc hasn't been updated
        $this->getJson('/api/production_blocs/' .$productionBloc_before_update->id)
             ->assertStatus(200)
             ->assertJson($productionBloc_before_update->toArray());
    }

    // Test suppression bloc
}
