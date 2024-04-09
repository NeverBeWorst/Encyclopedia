<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatureRequest;
use App\Models\Creature;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Review;
use App\Models\User;

class CreatureController extends Controller
{
    public function submit(CreatureRequest $req)
    {
        $creature = new Creature();
        $creature->name = $req->input('name');
        $creature->img = "img/carts/".$req->input('img');
        $creature->mythology = $req->input('mythology');
        $creature->habitat = $req->input('habitat');
        $creature->short_description = $req->input('short_description');
        $creature->description = $req->input('description');
        $creature->save();
        return redirect(route('admin'));
    }

    public function index(Request $req) {
        $creatures = Creature::all();

        return view('gallery', ['creatures' => $creatures]);
    }

    public function creature_view(string $id) {
        $creature = Creature::find($id);
        $users = User::all();

        if(!$creature) {
            $errorMessage = "Заявление не найдено";
            return redirect()->back()->withErrors($errorMessage);
        }
        
        $reviews = Review::all()->where('creature_id', '==', $id);

        return view('gallery_creature', ['creature' => $creature, 'reviews' => $reviews, 'users' => $users]);
    }

    public function search(SearchRequest $req) {
        $creatures = Creature::all();
        $mythology = $req->input('mythology');
        $habitat = $req->input('habitat');

        if($mythology) {
            $creatures = $creatures->where('mythology', '==', $mythology);
        }
        if ($habitat) {
            $creatures = $creatures->where('habitat', '==', $habitat);
        }

        return view('gallery', ['creatures' => $creatures, 'mythology' => $mythology, 'habitat' => $habitat]);
    }
}
