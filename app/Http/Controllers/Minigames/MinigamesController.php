<?php

namespace App\Http\Controllers\Minigames;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Creature;

class MinigamesController extends Controller
{
    public function select() {
        return view('minigames/select');
    }

    public function find_pair() {
        $creatures = Creature::all();

        $creatures = $creatures->shuffle();

        $creatures->splice(2);

        return view('minigames/find_pair', ['creatures' => $creatures]);
    }
}
