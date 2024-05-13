<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProposalCreatureRequest;
use App\Http\Requests\CustomCreatureRequest;
use App\Http\Requests\AvatarRequest;

use Illuminate\Support\Facades\Auth;

use App\Models\ProposalCreature;
use App\Models\CustomCreature;
use App\Models\User;
use App\Models\Friends;

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

        $creature = ProposalCreature::create([
            'img' => $img_name . '.' . $extension,
        ] + $req->all());

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

        $creature = CustomCreature::create([
            'user_id' => Auth::user()->id,
            'img' => $img_name . '.' . $extension,
        ] + $req->all());

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
            $friends = Friends::query()->where('sent_for', Auth::user()->login)->orWhere('sent_from', Auth::user()->login)->get();
            
            $friends =  $friends->where('status', '==', 'confirm');


            $friends_request = Friends::all()->where('sent_for', Auth::user()->login);
            $friends_request = $friends_request->where('status', '==', 'waiting');

            $users = User::all()->where('login', '==', Friends::query()->where('sent_for', Auth::user()->login)->orWhere('status', '==', 'waiting'));
        }
        else {
            $custom_creatures = null;
            $friends = null;
            $friends_request = null;
        }

        return view('profile', ['custom_creatures' => $custom_creatures, 'friends_request' =>  $friends_request, 'friends' => $friends]);
    }

    public function add_avatar(AvatarRequest $req) {
        if (!$req->has('image')) {
            return redirect()->back()->withErrors('Файл не найден');
        }

        $user = Auth::user();

        $file = $req->file('image');
        $extension = $req->file('image')->extension();
        $file->storeAs('users/avatar/', $user->login . "." . $extension , 'test');

        $user->avatar = $user->login . "." . $extension;
        $user->save();

        return redirect()->back();
    }

    public function friend_request(string $id) {
        $user1 = User::find($id);
        $user2 = Auth::user();

        $friend = new Friends();
        $friend->sent_from = $user2->login;
        $friend->sent_for = $user1->login;
        $friend->save();

        return redirect()->back();
    }

    public function confirm_friend_request(string $id) {
        $user1 = User::find($id);
        $user2 = Auth::user();

        $friend = Friends::all()
            ->where('sent_for', $user1)
            ->where('sent_from', $user2);

        $friend->status = 'confirm';
        $friend->save();

        return redirect()->back();
    }

    public function reject_friend_request(string $id) {
        $user1 = User::find($id);
        $user2 = Auth::user();

        $friend = Friends::all()
            ->where('sent_for', $user1)
            ->where('sent_from', $user2);

        $friend->status = 'reject';
        $friend->save();

        return redirect()->back();
    }
}
