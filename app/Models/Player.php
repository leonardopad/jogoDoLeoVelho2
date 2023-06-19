<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function games()
    {
        return Game::query()->where('player1_id', $this->id)
            ->orWhere('player2_id', $this->id)
            ->get();
    }
}
