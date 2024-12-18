<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        // Return the Blade view
        return view('frontend.game.list');
    }

    public function fetchGames()
    {
        // Return game data as JSON
        $games = Game::all();
        return response()->json([
            'success' => true,
            'data' => $games,
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Game::create([
            'name' => $input['name'],
            'creator' => $input['creator'],

        ]);
        return response()->json([
            'success' => true,
            'msg' => 'game saved successfully'
        ]);

    }

}
