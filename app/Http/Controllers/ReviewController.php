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

        $review = new Review();
        $review->user_id = $user->id;
        $review->user_name = $user->login;
        $review->creature_id = $id;
        $review->text = $req->input('text');
        $review->save();

        return redirect(route('gallery_creature', $id));
    }


    public function creature_reviews(string $creature_id) {
        $reviews = Review::where('creature_id', $creature_id);

        return view('gallery_creature', ['reviews' => $reviews, 'creatures' => $creatures]);
    }
}
