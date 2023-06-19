<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlayerSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Player::factory(10)->create();
    }
}
