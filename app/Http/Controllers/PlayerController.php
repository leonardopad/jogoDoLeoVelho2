<?php

namespace App\Http\Controllers;

use App\Action\Player\ActionCreatePlayer;
use App\Models\Player;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        return response()->json(Player::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        ActionCreatePlayer::prepare($data['name'],
            $data['email'],
            $data['nickname'],
            $data['password']
        );
        return response()->json(ActionCreatePlayer::execute());
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        return response()->json($player);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        foreach ($request->all() as $key => $value) {
            $player->$key = $value;
        }
        $player->save();
        $player->refresh();
        return response()->json($player);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        $player->delete();
        return response()->json([]);
    }
}
