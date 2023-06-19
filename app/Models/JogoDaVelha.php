<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JogoDaVelha extends Model {
    
    public static function getJogoDaVelha($request) {
        return [
            'pos1' => $request->post('pos1'),
            'pos2' => $request->post('pos2'),
            'pos3' => $request->post('pos3'),
            'pos4' => $request->post('pos4'),
            'pos5' => $request->post('pos5'),
            'pos6' => $request->post('pos6'),
            'pos7' => $request->post('pos7'),
            'pos8' => $request->post('pos8'),
            'pos9' => $request->post('pos9'),
        ];
    }

    public static function checkGanhadorByJogoVelha($jogo) {
        if(isset($jogo['pos1']) && $jogo['pos1'] == $jogo['pos2'] && $jogo['pos2'] == $jogo['pos3']) {
            return ['STATUS'=> 'GANHADOR => '.$jogo['pos1']];
        } else if(isset($jogo['pos4']) && $jogo['pos4'] == $jogo['pos5'] && $jogo['pos5'] == $jogo['pos6']) {
            return ['STATUS'=> 'GANHADOR => '.$jogo['pos4']];
        } else if(isset($jogo['pos7']) && $jogo['pos7'] == $jogo['pos8'] && $jogo['pos8'] == $jogo['pos9']) {
            return ['STATUS'=> 'GANHADOR => '.$jogo['pos7']];
        } else if (isset($jogo['pos1']) && $jogo['pos1'] == $jogo['pos4'] && $jogo['pos4'] == $jogo['pos7']) {
            return ['STATUS'=> 'GANHADOR => '.$jogo['pos1']];
        } else if (isset($jogo['pos2']) && $jogo['pos2'] == $jogo['pos5'] && $jogo['pos5'] == $jogo['pos8']) {
            return ['STATUS'=> 'GANHADOR => '.$jogo['pos2']];
        } else if (isset($jogo['pos3']) && $jogo['pos3'] == $jogo['pos6'] && $jogo['pos6'] == $jogo['pos9']) {
            return ['STATUS'=> 'GANHADOR => '.$jogo['pos2']];
        } else if (isset($jogo['pos1']) && $jogo['pos1'] == $jogo['pos5'] && $jogo['pos5'] == $jogo['pos9']) {
            return ['STATUS'=> 'GANHADOR => '.$jogo['pos1']];
        } else if (isset($jogo['pos3']) && $jogo['pos3'] == $jogo['pos5'] && $jogo['pos5'] == $jogo['pos7']) {
            return ['STATUS'=> 'GANHADOR => '.$jogo['pos1']];
        } else if(isset($jogo['pos1']) && isset($jogo['pos2']) && isset($jogo['pos3']) && isset($jogo['pos4']) && isset($jogo['pos5']) && isset($jogo['pos6'])
                  && isset($jogo['pos7']) && isset($jogo['pos8']) && isset($jogo['pos9'])) {
            return ['STATUS' => 'DEU VELHA'];
        }
        return ['STATUS' => 'EM ANDAMENTO'];
    }
}