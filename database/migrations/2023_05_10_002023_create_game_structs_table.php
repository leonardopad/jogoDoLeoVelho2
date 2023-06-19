<?php

use App\Models\Player;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * + positions: HashMap<Position, Value>
     * + whoStarted: Player
     * + currentMove: Player
     */
    public function up(): void
    {
        Schema::create('game_structs', function (Blueprint $table) {
            $table->id();
            $table->json('positions');
            $table->foreignIdFor(Player::class, 'who_started');
            $table->foreignIdFor(Player::class, 'current_move');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_structs');
    }
};
