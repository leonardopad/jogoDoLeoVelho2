<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_new_game(): void
    {
        $response = $this->postJson('/api/v1/game/create', [
            'player1_id' => 5,
            'player2_id' => 6,
        ]);

        $response->assertStatus(201);
        dump($response->getContent());
    }

    public function test_get_one_game()
    {
        $response = $this->get('/api/v1/game/1');

        dd($response->content);
    }
}
