<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    public function index(RegisterRequest $req) {

        $user = User::create([
            'password' => bcrypt($req->password),
            'admin' => false,
        ] + $req->all());
        return redirect(route('profile'));
    }
}
