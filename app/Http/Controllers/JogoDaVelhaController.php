<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JogoDaVelha;
use App\Models\Player;
use Illuminate\Support\Facades\Hash;

class JogoDaVelhaController extends Controller
{
    public function index(Request $request) {
        $jogo_velha = JogoDaVelha::getJogoDaVelha($request);
        return JogoDaVelha::checkGanhadorByJogoVelha($jogo_velha);
    }

    public function login(Request $request) {

        if(!$request->post('nickname') || !$request->post('password')) return;
        
        $usuario = Player::where('nickname', $request->post('nickname'))->first();
        $isPassword = Hash::check($request->post('password'), $usuario->password);
        if($isPassword) {
            echo json_encode($usuario);
        }
    }
}
