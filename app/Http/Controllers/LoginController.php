<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Session;


use RobThree\Auth\TwoFactorAuth;


class LoginController extends Controller
{
    public function index(LoginRequest $req) {
        $credentials = $req->only(['login', 'password']);

        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            $user_name = $user->login;
            Session::put('user_name', $user_name);

            return redirect(route('profile'));
        }
        else {
            $errorMessage = "Пользователь не найден";
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function logout(Request $req) {
        Auth::logout();
        $req->session()->flush();
        return redirect()->back()->with('success', 'Вы успешно вышли');
    }

    public function password_recovery(LoginRequest $req) {
        $tfa = new TwoFactorAuth();
    }
}
