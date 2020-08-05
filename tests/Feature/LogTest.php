<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Log;

class LogTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function test_log_can_list()
    {
        $logs = factory(Log::class, 10)->create();

        $this->getJson('/api/logs')
             ->assertStatus(200)
             ->assertJson($logs->toArray());
    }

    public function test_log_can_get_list_of_specific_user()
    {
        $user = factory(\App\User::class)->create();
        $logs = factory(Log::class, 10)->create([
            'user_id' => $user->id,
        ]);

        $this->getJson('/api/users/' . $user->id . "/logs")
             ->assertStatus(200)
             ->assertJson($logs->toArray());
    }

    public function test_log_observer_can_get_created_event_of_production_bloc()
    {
        $productionBloc = factory(\App\Models\ProductionBloc::class)->create();
        $log = [
            'user_id' => $productionBloc->game->user->id,
            'table' => $productionBloc->getTable(),
            'action' => 'created'
        ];

        $this->assertDatabaseHas('logs', $log)
             ->assertDatabaseCount('logs', 1);
    }

    public function test_log_observer_can_get_updated_event_of_production_bloc()
    {
        $productionBloc = factory(\App\Models\ProductionBloc::class)->create();

        $update_data = [
            'game_id' => $productionBloc->game->id,
            'name' => $this->faker->name
        ];

        $this->putJson('/api/production_blocs/' . $productionBloc->id, $update_data);

        $log = [
            'user_id' => $productionBloc->game->user->id,
            'table' => $productionBloc->getTable(),
            'action' => 'updated'
        ];

        $this->assertDatabaseHas('logs', $log)
             ->assertDatabaseCount('logs', 2);
    }

    public function test_log_observer_can_get_deleted_event_of_production_bloc()
    {
        $productionBloc = factory(\App\Models\ProductionBloc::class)->create();

        $this->deleteJson('/api/production_blocs/' . $productionBloc->id);

        $log = [
            'user_id' => $productionBloc->game->user->id,
            'table' => $productionBloc->getTable(),
            'action' => 'deleted'
        ];

        $this->assertDatabaseHas('logs', $log)
             ->assertDatabaseCount('logs', 2);
    }
}
