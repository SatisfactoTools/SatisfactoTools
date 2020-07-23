<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Game;

class GameTest extends TestCase
{
    use RefreshDatabase;

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
}
