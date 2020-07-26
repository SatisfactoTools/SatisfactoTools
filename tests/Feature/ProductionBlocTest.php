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
     * Test that production bloc
     *
     * @return void
     */
    public function test_production_bloc_can_list()
    {
        $productionBlocs = factory(ProductionBloc::class, 3)->create();

        $this->get('/api/production_blocs')
             ->assertStatus(200)
             ->assertJson($productionBlocs->toArray());
    }

    // Test liste des blocs
    // Test affichage un bloc
    // Test creation bloc
    // Test modif bloc
    // Test suppression bloc
    // Test game existe pas pendant création bloc
    // Test game existe pas pendant modif bloc
}
