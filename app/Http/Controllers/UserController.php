<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProposalCreatureRequest;
use App\Http\Requests\CustomCreatureRequest;

use Illuminate\Support\Facades\Auth;

use App\Models\ProposalCreature;
use App\Models\CustomCreature;
use App\Models\User;

use Carbon\Carbon;


class UserController extends Controller
{
    public function proposal_creature(ProposalCreatureRequest $req) {
        if (!$req->has('image')) {
            return redirect()->back()->withErrors('Файл не найден');
        }

        $img_name = Auth::user()->login . Carbon::now()->format('y-m-d-h-m-s') ;


        $file = $req->file('image');
        $extension = $req->file('image')->extension();
        $file->storeAs('users/proposal_creature/carts/', $img_name . "." . $extension , 'test');

        $creature = new ProposalCreature;
        $creature->name = $req->input('name');

        $creature->img = $img_name . '.' . $extension;

        $creature->mythology = $req->input('mythology');
        $creature->habitat = $req->input('habitat');
        $creature->short_description = $req->input('short_description');
        $creature->description = $req->input('description');
        $creature->status = 'waiting';
        $creature->save();

        return redirect(route('profile'));;
    }

    public function custom_creature(CustomCreatureRequest $req) {
        if (!$req->has('image')) {
            return redirect()->back()->withErrors('Файл не найден');
        }

        $img_name = Auth::user()->login . Carbon::now()->format('y-m-d-h-m-s') ;

        $file = $req->file('image');
        $extension = $req->file('image')->extension();
        $file->storeAs('users/custom_creature/carts/', $img_name . "." . $extension , 'test');

        $creature = new CustomCreature;
        $creature->user_id = Auth::user()->id;
        $creature->name = $req->input('name');
        $creature->img = $img_name . '.' . $extension;
        $creature->habitat = $req->input('habitat');
        $creature->short_description = $req->input('short_description');
        $creature->description = $req->input('description');
        $creature->save();

        return redirect(route('profile'));;
    }

    public function user_profile(string $id) {
        $user = User::find($id);

        $custom_creatures = CustomCreature::all()->where('user_id', '==', $user->id);

        return view('user/profile', ['user' => $user, 'custom_creatures' => $custom_creatures]);
    }

    public function profile() {
        if(Auth::user()) {
            $custom_creatures = CustomCreature::all()->where('user_id', '==', Auth::user()->id);
        }
        else {
            $custom_creatures = null;
        }

        return view('profile', ['custom_creatures' => $custom_creatures]);
    }

    public function add_avatar() {

    }
}
