<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function profile() {
        return view('profile');
    }

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

}
