<?php

use App\Enum\ResultGame;
use App\Enum\StatusGame;
use App\Models\GameStruct;
use App\Models\Player;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
            + id: int
            + status: EnumGame
            + player1: Player
            + player2: Player
            + gameStruct: GameStruct
            + gameMoveList: GameMove
            + resultGame: ResultGame
            + startedGameTime: DateTime
            + finishedGameTime: DateTime
         */
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->enum('status', StatusGame::options());
            $table->foreignIdFor(Player::class, 'player1_id');
            $table->foreignIdFor(Player::class, 'player2_id');
            $table->foreignIdFor(GameStruct::class);
            $table->enum('result', ResultGame::options())->nullable();
            $table->dateTime('started_game_time');
            $table->dateTime('finished_game_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
