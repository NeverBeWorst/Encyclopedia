<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CreatureController;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\User;
use App\Models\Creature;

class AdminController extends Controller
{
    public function index(Request $req) {
        $users = User::all();

        return view('admin', ['users' => $users, '_mythology' => CreatureController::$_mythology, '_habitat' => CreatureController::$_habitat]);
    }

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
            $users = $users->where('login', '==', $name);
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

    public function proposal_add_creature() {
        return view('admin/proposal_add_creature');
    }

    public function confirm_proposal(string $id) {

    }

    public function reject_proposal(string $id) {
        
    }

}
