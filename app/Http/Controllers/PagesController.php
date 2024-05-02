<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    public function home() {
        return view('home');
    }

    public function reg() {
        return view('reg');
    }

    public function login() {
        return view('login');
    }

    public function gallery() {
        return view('gallery');
    }

    public function admin() {
        return view('admin');
    }

    public function password_recovery() {
        return view('password_recovery');
    }

    public function proposal_creature() {
        return view('user/proposal_creature', ['_mythology' => CreatureController::$_mythology, '_habitat' => CreatureController::$_habitat]);
    }

    public function custom_creature() {
        return view('user/custom_creature', ['_habitat' => CreatureController::$_habitat]);
    }

}
