<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CreatureRequest;
use App\Http\Requests\CreaturesPhotoRequest;
use App\Http\Requests\CreatureWithImageRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\ProposalCreatureRequest;

use App\Models\Creature;
use App\Models\ProposalCreature;
use App\Models\CustomCreature;
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
        'Европейская',
        'Другое',
    ];

    public static $_habitat = [
        'Болото',
        'Поля/луга',
        'Заброшенные сооружения',
        'Дома',
        'Сны',
        'Леса',
        'Другое',
        'Везде',
    ];



    public function submit(CreatureRequest $req)
    {
        $creature = Creature::create($req->all());

        return redirect(route('admin.main'));
    }

    public function image_submit(CreaturesPhotoRequest $req) {
        $file = $req->file('image');
        $extension = $req->file('image')->extension();
        $file->storeAs('carts', $req->img_name . "." . $extension , 'test');

        return redirect(route('admin.main'));
    }

    public function submit_with_image(CreatureWithImageRequest $req) {
        if (!$req->has('image')) {
            return redirect()->back()->withErrors('Файл не найден');
        }

        $file = $req->file('image');
        $extension = $req->file('image')->extension();
        $file->storeAs('carts', $req->img_name . "." . $extension , 'test');

        $creature = Creature::create([
            'img' => $req->img_name . "." . $extension,
        ] + $req->all());

        return redirect(route('admin.main'));
    }

    public function index(Request $req) {
        $creatures = Creature::all();

        $creatures = $creatures->shuffle();

        $creatures->splice(30);

        return view('gallery', ['creatures' => $creatures, 'mythology' => null, 'habitat' => null
        , '_mythology' => CreatureController::$_mythology, '_habitat' => CreatureController::$_habitat, 'name' => '']);
    }

    public function creature_view(string $id) {
        $creature = Creature::find($id);
        $users = User::all();

        if(!$creature) {
            return redirect()->back()->withErrors("Заявление не найдено");
        }

        $creature_text = preg_split('/\r\n|\r|\n/', $creature->description);
        
        $reviews = Review::all()->where('creature_id', '==', $id);

        return view('gallery_creature', ['creature' => $creature, 'reviews' => $reviews, 'users' => $users, 'creature_text' => $creature_text]);
    }

    public function custom_creature_view(string $id) {
        $creature = CustomCreature::find($id);
        $users = User::all();

        if(!$creature) {
            return redirect()->back()->withErrors("Заявление не найдено");
        }

        $creature_text = preg_split('/\r\n|\r|\n/', $creature->description);

        $reviews = null;

        $creature->img = '../users/custom_creature/carts/' .  $creature->img;

        $autor = User::find($creature->user_id);

        return view('gallery_creature', ['creature' => $creature, 'reviews' => $reviews, 'users' => $users, 'creature_text' => $creature_text, 'autor' => $autor]);
    }

    public function search(SearchRequest $req) {
        $creatures = Creature::all();
        $mythology = $req->input('mythology');
        $habitat = $req->input('habitat');
        $name = $req->input('name');
        $custom = $req->input('custom');
 
        if($mythology) {
            $creatures = $creatures->where('mythology', '==', $mythology);
        }

        if ($habitat) {
            $creatures = $creatures->where('habitat', '==', $habitat);
        }

        if($name) {
            $creatures = Creature::query();
            $creatures = $creatures->where('name', 'like', '%'.$name.'%');
            $creatures = $creatures->get(); 
        }

        if($custom) {
            switch ($custom) {
                case 'with_custom': 
                    $creatures = $creatures->merge(CustomCreature::all());
                    break;
                case 'only_custom':
                    $creatures = CustomCreature::all();
                    break;
                default:
                    break;
            }
        }
        
        $creatures = $creatures->shuffle();
        
        return view('gallery', ['creatures' => $creatures, 'mythology' => $mythology, 'habitat' => $habitat
        , '_mythology' => CreatureController::$_mythology, '_habitat' => CreatureController::$_habitat, 'name' => $name]);
    }

    public function suggestions(SearchRequest $req) {
        $creatures = Creature::all();
        $name = $req->searchText;
        $suggestions = [];
        if($name) {
            $creatures = Creature::query();
            $creatures = $creatures->where('name', 'like', '%'.$name.'%');
            $creatures = $creatures->get(); 
        }

        $suggestions = $creatures->pluck('name')->values();

        return response()->json($suggestions);
    }
}
