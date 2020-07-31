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

    /**
     * Test that production unite can be updated
     *
     * @return void
     */
    public function test_production_unite_can_update()
    {
        $productionUnite_before_update = factory(ProductionUnite::class)->create();
        
        $productionUnite_update_data = [
            'recipe_id'          => factory(\App\Models\Recipe::class)->create()->id,
            'building_id'        => factory(\App\Models\Building::class)->create()->id,
            'production_bloc_id' => factory(\App\Models\ProductionBloc::class)->create()->id,
            'name' => $this->faker->name
        ];

        // Assert that production unite return a confirmation message
        $this->putJson('/api/production_unites/' . $productionUnite_before_update->id, $productionUnite_update_data)
             ->assertStatus(200)
             ->assertJson([
                 'message' => "Production Unite successfully updated"
             ]);
        
        // Assert that production unite is correctly updated
        $this->getJson('/api/production_unites/' .$productionUnite_before_update->id)
             ->assertStatus(200)
             ->assertJson($productionUnite_update_data);
    }

    /**
     * Test that production unite can send error mwhen giving wrong recipe id
     *
     * @return void
     */
    public function test_production_unite_can_send_error_with_wrong_recipe_id_when_update()
    {
        $productionUnite_before_update = factory(ProductionUnite::class)->create();
        
        $productionUnite_update_data = [
            'recipe_id'          => 5,
            'building_id'        => factory(\App\Models\Building::class)->create()->id,
            'production_bloc_id' => factory(\App\Models\ProductionBloc::class)->create()->id,
            'name' => $this->faker->name
        ];

        // Assert that production unite return a error message
        $this->putJson('/api/production_unites/' . $productionUnite_before_update->id, $productionUnite_update_data)
             ->assertStatus(404)
             ->assertJson([
                 'message' => "Recipe not found"
             ]);
        
        // Assert that production unite hasn't been updated
        $this->getJson('/api/production_unites/' .$productionUnite_before_update->id)
             ->assertStatus(200)
             ->assertJson($productionUnite_before_update->toArray());
    }

    /**
     * Test that production unite can send error mwhen giving wrong building id
     *
     * @return void
     */
    public function test_production_unite_can_send_error_with_wrong_building_id_when_update()
    {
        $productionUnite_before_update = factory(ProductionUnite::class)->create();
        
        $productionUnite_update_data = [
            'recipe_id'          => factory(\App\Models\Recipe::class)->create()->id,
            'building_id'        => 5,
            'production_bloc_id' => factory(\App\Models\ProductionBloc::class)->create()->id,
            'name' => $this->faker->name
        ];

        // Assert that production unite return a error message
        $this->putJson('/api/production_unites/' . $productionUnite_before_update->id, $productionUnite_update_data)
             ->assertStatus(404)
             ->assertJson([
                 'message' => "Building not found"
             ]);
        
        // Assert that production unite hasn't been updated
        $this->getJson('/api/production_unites/' .$productionUnite_before_update->id)
             ->assertStatus(200)
             ->assertJson($productionUnite_before_update->toArray());
    }

    /**
     * Test that production unite can send error mwhen giving wrong production bloc id
     *
     * @return void
     */
    public function test_production_unite_can_send_error_with_wrong_production_bloc_id_when_update()
    {
        $productionUnite_before_update = factory(ProductionUnite::class)->create();
        
        $productionUnite_update_data = [
            'recipe_id'          => factory(\App\Models\Recipe::class)->create()->id,
            'building_id'        => factory(\App\Models\Building::class)->create()->id,
            'production_bloc_id' => 5,
            'name' => $this->faker->name
        ];

        // Assert that production unite return a error message
        $this->putJson('/api/production_unites/' . $productionUnite_before_update->id, $productionUnite_update_data)
             ->assertStatus(404)
             ->assertJson([
                 'message' => "Production Bloc not found"
             ]);
        
        // Assert that production unite hasn't been updated
        $this->getJson('/api/production_unites/' .$productionUnite_before_update->id)
             ->assertStatus(200)
             ->assertJson($productionUnite_before_update->toArray());
    }

    /**
     * Test that production unite can be deleted
     *
     * @return void
     */
    public function test_production_unite_can_delete()
    {
        $productionUnite = factory(ProductionUnite::class)->create();

        // Assert that production unite has been deleted
        $this->deleteJson('/api/production_unites/' . $productionUnite->id)
             ->assertStatus(200)
             ->assertJson([
                 'message' => 'Production Unite successfully deleted'
             ]);
        
        // Assert that production unite doesn't exist anymore
        $this->getJson('/api/production_unites/' . $productionUnite->id)
             ->assertStatus(404)
             ->assertJsonMissing($productionUnite->toArray());
    }

    /**
     * Test that production unite can send error when giving wrong production unite id
     *
     * @return void
     */
    public function test_production_unite_send_error_with_wrong_production_unite_id_when_delete()
    {
        $this->deleteJson('/api/production_unites/' . "5")
             ->assertStatus(404);
    }
}
