<?php

namespace Tests\Unit\Action\Player;

use App\Action\Player\ActionCreatePlayer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ActionCreatePlayerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatePlayer(): void
    {
        // arrange
        $data = [
            'name'      => fake()->name(),
            'email'     => fake()->unique()->safeEmail(),
            'nickname' => fake()->unique()->userName(),
            'password'  => Hash::make('teste')
        ];
        // act
        ActionCreatePlayer::prepare($data['name'],
            $data['email'],
            $data['nickname'],
            $data['password']
        );
        $playerCreated = ActionCreatePlayer::execute();
        // assert
        $this->assertInstanceOf('\App\Models\Player', $playerCreated);
    }

    public function testCreatePlayerNickNameExists(): void
    {
        // arrange
        $player = \App\Models\Player::factory(1)->create();
        ActionCreatePlayer::prepare($player->first()->name,
            $player->first()->email,
            $player->first()->nickname,
            $player->first()->password
        );
        // assert
        $this->expectExceptionMessage("Não e possivel criar um nickname repetido.");
        // act
        ActionCreatePlayer::execute();
    }

    public function testCreatePlayerNickNameExistsForDeletedPlayer(): void
    {
        // arrange
        $player = \App\Models\Player::factory(1)->create();
        $player->first()->delete();
        ActionCreatePlayer::prepare($player->first()->name,
           $player->first()->email,
           $player->first()->nickname,
           $player->first()->password
        );
        $playerCreated = ActionCreatePlayer::execute();
        $this->assertInstanceOf('\App\Models\Player', $playerCreated);
    }
}
