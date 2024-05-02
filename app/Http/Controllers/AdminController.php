<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CreatureController;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Creature;
use App\Models\ProposalCreature;
use App\Models\CustomCreature;

use Session;
use File;
use Carbon\Carbon;
use Storage;

class AdminController extends Controller
{
    public function index(Request $req) {
        $users = User::all();

        return view('admin', ['users' => $users, '_mythology' => CreatureController::$_mythology, '_habitat' => CreatureController::$_habitat]);
    }

    //

    public function users() {
        $users = User::all();

        return view('admin/users', ['users' => $users, 'search' => false]);
    }

    public function users_search(Request $req) {
        $users = User::query();
        $id = $req->input('id');
        $name = $req->input('name');

        if ($id) {
            $users = User::find($id);
            // if (User::find($id - 1)) $users->push(User::find($id - 1));
            // if (User::find($id + 1)) $users->push(User::find($id + 1));
        }
        if ($name) {
            $users = $users->where('login', 'like', '%' . $name . '%');
        }

        return view('admin/users', ['users' => $users, 'search' => true]);
    }


    public function user_block(string $id) {
        return redirect(route('admin/users'));
    }


    public function user_delete(Request $req, string $id) {
        User::destroy($id);
        return redirect(route('admin/users'));
    }


    //


    public function proposal_creature() {
        $creatures = ProposalCreature::all()->where('status', '==', 'waiting');
        return view('admin/proposal_creature', ['creatures' => $creatures]);
    }


    public function proposal_creature_view($id) {
        $creature = ProposalCreature::find($id);
        return view('admin/proposal_creature_view', ['creature' => $creature]);
    }
    

    public function confirm_proposal(string $id) {
        $_creature = ProposalCreature::find($id);

        $_creature->status = 'confirm';

        $_creature->save();

        $img = $_creature->img;

        //$extension = last( explode('.', $img ) );

        $new_path =  public_path() . '/img/carts/' . $img;
        $old_path =  public_path() . '/img/users/proposal_creature/carts/' . $img;
        $move = File::move($old_path, $new_path);
        

        $creature = new Creature();
        $creature->name = $_creature->name;
        $creature->img = $img;
        $creature->mythology = $_creature->mythology;
        $creature->habitat = $_creature->habitat;
        $creature->short_description = $_creature->short_description;
        $creature->description = $_creature->description;
        $creature->save();

        // $_creature->img = '../../../img/carts/' . $creature->img;

        return view('admin/proposal_creature', ['creatures' => ProposalCreature::all()]);
    }


    public function reject_proposal(string $id) {
        $creature = ProposalCreature::find($id);

        $creature->status = 'reject';

        $creature->save();

        return view('admin/proposal_creature', ['creatures' => ProposalCreature::all()]);
    }

    //

    public function custom_creatures() {
        return view('admin/custom_creature', ['creatures' => CustomCreature::all()]);
    }

}
