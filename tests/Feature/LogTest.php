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
}
