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
     * A basic feature test example.
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

    // test production unite can list from a user
    // test production unite can show
    // test production unite can be created
    // test production unite can be updated
    // test production unite can be deleted
}
