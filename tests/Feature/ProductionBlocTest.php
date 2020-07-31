<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ProductionBloc;
use App\Models\ProductionUnite;

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

    /**
     * Test that production bloc can be deleted
     *
     * @return void
     */
    public function test_production_bloc_can_delete()
    {
        $productionBloc = factory(ProductionBloc::class)->create();

        // Assert that production bloc has been deleted
        $this->deleteJson('/api/production_blocs/' .$productionBloc->id)
             ->assertStatus(200)
             ->assertJson(['message' => "Production bloc successfully deleted"]);
        
        // Assert that production bloc does not exist anymore
        $this->getJson('/api/production_blocs/' .$productionBloc->id)
             ->assertJsonMissing($productionBloc->toArray());

    }

    /**
     * Test that production bloc can send error when given wrong production bloc id
     *
     * @return void
     */
    public function test_production_bloc_can_send_error_with_wrong_production_bloc_id_when_delete()
    {
        $this->deleteJson('/api/production_blocs/' . "5")
             ->assertStatus(404);
    }

    /**
     * Test that production bloc can be connected to another production bloc
     *
     * @return void
     */
    public function test_production_bloc_can_be_connect_to_another_production_bloc()
    {
        $productionBloc_parent = factory(ProductionBloc::class)->create();
        $productionBloc_child = factory(ProductionBloc::class)->create();

        $this->postJson('/api/production_blocs/' . $productionBloc_parent->id . '/connect/' . $productionBloc_child->id)
             ->assertStatus(200)
             ->assertJson(['message' => "Production blocs successfully connected"]);
    }

    /**
     * Test that production bloc can show a child
     *
     * @return void
     */
    public function test_production_bloc_can_show_child()
    {
        $productionBloc_parent = factory(ProductionBloc::class)->create();
        $productionBloc_child = factory(ProductionBloc::class)->create();

        $this->postJson('/api/production_blocs/' . $productionBloc_parent->id . '/connect/' . $productionBloc_child->id);

        $productionBloc_child->parent_id = $productionBloc_parent->id;

        $this->getJson('/api/production_blocs/' . $productionBloc_parent->id . '/children')
             ->assertStatus(200)
             ->assertJson([$productionBloc_child->toArray()]);
    }

    /**
     * Test that production bloc can show children
     *
     * @return void
     */
    public function test_production_bloc_can_show_children()
    {
        $productionBloc_parent = factory(ProductionBloc::class)->create();

        $productionBloc_child1 = factory(ProductionBloc::class)->create();
        $productionBloc_child2 = factory(ProductionBloc::class)->create();
        $productionBloc_child3 = factory(ProductionBloc::class)->create();

        $this->postJson('/api/production_blocs/' . $productionBloc_parent->id . '/connect/' . $productionBloc_child1->id);
        $this->postJson('/api/production_blocs/' . $productionBloc_parent->id . '/connect/' . $productionBloc_child2->id);
        $this->postJson('/api/production_blocs/' . $productionBloc_parent->id . '/connect/' . $productionBloc_child3->id);

        $productionBloc_child1->parent_id = $productionBloc_parent->id;
        $productionBloc_child2->parent_id = $productionBloc_parent->id;
        $productionBloc_child3->parent_id = $productionBloc_parent->id;

        $this->getJson('/api/production_blocs/' . $productionBloc_parent->id . '/children')
             ->assertStatus(200)
             ->assertJson([
                 $productionBloc_child1->toArray(),
                 $productionBloc_child2->toArray(),
                 $productionBloc_child3->toArray()
             ]);
    }

    /**
     * Test that production bloc can show his parent
     *
     * @return void
     */
    public function test_production_bloc_can_show_parent()
    {
        $productionBloc_parent = factory(ProductionBloc::class)->create();
        $productionBloc_child = factory(ProductionBloc::class)->create();

        $this->postJson('/api/production_blocs/' . $productionBloc_parent->id . '/connect/' . $productionBloc_child->id);

        $productionBloc_child->parent_id = $productionBloc_parent->id;

        $this->getJson('/api/production_blocs/' .$productionBloc_child->id ."/parent")
             ->assertStatus(200)
             ->assertJson($productionBloc_parent->toArray());
    }

    public function test_production_bloc_can_list_production_unites()
    {
        $productionBloc = factory(ProductionBloc::class)->create();
        $productionUnites = factory(ProductionUnite::class, 5)->create([
            'production_bloc_id' => $productionBloc->id
        ]);

        $this->getJson('/api/production_blocs/' . $productionBloc->id . '/production_unites')
             ->assertStatus(200)
             ->assertJson($productionUnites->toArray());
    }

}
