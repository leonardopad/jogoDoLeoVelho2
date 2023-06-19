<?php

namespace App\Action\Player;

use App\Models\Player;
use Exception;
use Illuminate\Support\Facades\Hash;

class ActionCreatePlayer
{
    private static string $name;
    private static string $email;
    private static string $nickname;
    private static string $password;

    public static function prepare(string $name, string $email,
     string $nickname, string $password)
    {
        self::$name  = $name;
        self::$email = $email;
        self::$nickname = $nickname;
        self::$password = $password;
    }

    public static function execute() : Player
    {
        if (self::validPlayerExistsByNickNameOrEmail()) {
            throw new Exception("Não e possivel criar um nickname repetido.");
        }

        $player = new Player();

        $player->name = self::$name;
        $player->nickname   = self::$nickname;
        $player->email      = self::$email;
        $player->password   = Hash::make(self::$password);

        $player->save();

        return $player;
    }

    public static function validPlayerExistsByNickNameOrEmail() : bool
    {
        $player = Player::query()->where('nickname', self::$nickname)
            ->orWhere('email', self::$email)
            ->get();

        return (bool) $player->count();
    }

}
