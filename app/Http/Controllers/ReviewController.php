<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function reviewstore(Request $request)
{
    // Check if user is admin
        if (Auth::user()->role === 1) {
            return redirect()->back()->with('error', 'Administrators are not allowed to submit reviews.');
        }

        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        $review = new Review();
        $review->comments = $request->comment;
        $review->star_rating = $request->rating;
        $review->user_id = Auth::id();
        $review->status = 'active';
        $review->save();

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    public function form_view()
    {
        $reviews = Review::with('user')->latest()->get();
        // Don't show personal review for admin users
        $userReview = Auth::check() && Auth::user()->role !== 1 
            ? Review::where('user_id', Auth::id())->first() 
            : null;
        return view('user/testimoni', compact('reviews', 'userReview'));
    }

    public function edit(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        
        // Check if user owns this review
        if (Auth::id() !== $review->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        return redirect()->route('review.view')
            ->with('editing', $id)
            ->with('oldReview', $review);
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        
        // Check if user is admin or doesn't own the review
        if (Auth::user()->role === 1 || Auth::id() !== $review->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        $review->comments = $request->comment;
        $review->star_rating = $request->rating;
        $review->save();

        return redirect()->back()->with('success', 'Review updated successfully!');
    }
    
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        // Check if user owns this review
        if (Auth::id() !== $review->user_id && Auth::user()->role !== 1) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully!');
    }
    
}