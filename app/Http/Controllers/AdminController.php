<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;

class AdminController extends Controller
{
    public function index(Request $req) {
        return view('admin');
    }
}
