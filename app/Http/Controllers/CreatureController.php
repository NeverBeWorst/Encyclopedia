<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CreatureRequest;
use App\Http\Requests\CreaturesPhotoRequest;
use App\Http\Requests\CreatureWithImageRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\SearchRequest;

use App\Models\Creature;
use App\Models\User;
use App\Models\Review;

class CreatureController extends Controller
{
    public static $_mythology = [
        'Древнегреческая',
        'Японская',
        'Славянская',
        'Скандинавская',
        'Финская',
        'Восточноевропейская',
        'Индийская',
        'Другое',
        'Пользовательская',
    ];

    public static $_habitat = [
        'Болото',
        'Поля/луга',
        'Заброшенные сооружения',
        'Дома',
        'Сны',
        'Леса',
        'Другое',
        'Пользовательская',
    ];

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

    public function image_submit(CreaturesPhotoRequest $req) {
        $file = $req->file('image');
        $extension = $req->file('image')->extension();
        $file->storeAs('carts', $req->img_name . "." . $extension , 'test');

        return redirect(route('admin'));
    }

    public function submit_with_image(CreatureWithImageRequest $req) {
        if (!$req->has('image')) {
            return redirect()->back()->withErrors('Файл не найден');
        }

        $file = $req->file('image');
        $extension = $req->file('image')->extension();
        $file->storeAs('carts', $req->img_name . "." . $extension , 'test');

        $creature = new Creature();
        $creature->name = $req->input('name');
        $creature->img = "img/carts/" . $req->img_name . "." . $extension;
        $creature->mythology = $req->input('mythology');
        $creature->habitat = $req->input('habitat');
        $creature->short_description = $req->input('short_description');
        $creature->description = $req->input('description');
        $creature->save();
        return redirect(route('admin'));
    }

    public function confirm_proposal(string $id) {

    }

    public function reject_proposal(string $id) {
        
    }

    public function index(Request $req) {
        $creatures = Creature::all();

        $creatures = $creatures->shuffle();

        return view('gallery', ['creatures' => $creatures, 'mythology' => null, 'habitat' => null
        , '_mythology' => CreatureController::$_mythology, '_habitat' => CreatureController::$_habitat]);
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
        

        return view('gallery', ['creatures' => $creatures, 'mythology' => $mythology, 'habitat' => $habitat
        , '_mythology' => CreatureController::$_mythology, '_habitat' => CreatureController::$_habitat]);
    }
}
