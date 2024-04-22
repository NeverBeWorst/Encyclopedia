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

        return view('admin/users', ['users' => $users]);
    }

    public function user_block(string $id) {
        
        return redirect(route('admin/users'));
    }

    public function user_delete(Request $req, string $id) {
        User::destroy($id);
        return redirect(route('admin/users'));
    }

    

}
