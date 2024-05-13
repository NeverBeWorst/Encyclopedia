<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;

use App\Http\Controllers\Controller;

use App\Models\Review;

use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function submit(ReviewRequest $req, string $id)
    {
        $user = Auth::user();

        if(!$user) {
            return redirect()->back()->withErrors('');
        }

        $review = Review::create([
            'user_id' => $user->id,
            'user_name' => $user->login,
            'creature_id' => $id,
            'text' => $req->input('text'),
        ]);

        return redirect(route('gallery.creature', $id));
    }


    public function creature_reviews(string $creature_id) {
        $reviews = Review::where('creature_id', $creature_id);

        return view('gallery_creature', ['reviews' => $reviews, 'creatures' => $creatures]);
    }
}
