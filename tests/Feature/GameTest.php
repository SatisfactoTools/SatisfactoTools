<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Game;

class GameTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_games_can_list()
    {
        // $now = now
        $games = factory(Game::class, 3)->create();

        $this->getJson('/api/games')
             ->assertStatus(200)
             ->assertJson($games->toArray());
    }

    public function test_games_can_show_one()
    {
        $game = factory(Game::class)->create();

        $this->getJson('/api/games/'. $game->id)
             ->assertStatus(200)
             ->assertJson($game->toArray());
    }

    public function test_games_can_create()
    {
        $game = [
            'user_id' => factory(\App\User::class)->create()->id,
            'name' => $this->faker->name,
        ];
        
        $this->postJson('/api/games', $game)
             ->assertStatus(201)
             ->assertJson($game);
    }

    /**
     * Test that games can be updated
     *
     * @return void
     */
    public function test_games_can_update()
    {
        $game_before_update = factory(Game::class)->create([
            'user_id' => factory(\App\User::class)->create()->id
        ]);

        $game_update_data = [
            'name' => "updated stuff"
        ];

        $game_updated = [
            'user_id' => $game_before_update->user_id,
            'name' => $game_update_data['name'],
        ];

        // Test that game can be updated
        $this->putJson('/api/games/'. $game_before_update->id, $game_update_data)
             ->assertStatus(200)
             ->assertJson(['message' => "Game successfully updated"]);

        // Test that game is correctly updated
        $this->getJson('/api/games/'. $game_before_update->id)
             ->assertJson($game_updated);
    }
}
