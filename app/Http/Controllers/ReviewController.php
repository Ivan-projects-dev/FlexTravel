<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    public function publicIndex()
    {
        $reviews = Review::all();
        return view('reviews.public_index', compact('reviews'));
    }
    public function index()
    {
        if (!auth()->check()) 
        {
            return redirect()->route('public.reviews'); 
        }
        $reviews = Review::all();
        return view ('reviews.index')->with('reviews', $reviews);
    }
    public function create()
    {
        return view('reviews.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'mark' => 'required|integer',
            'comment' => 'string',
        ]);
        $review = new Review([
            'mark' => $request->get('mark'),
            'comment' => $request->get('comment'),
            'user_id' => Auth::id(),
        ]);
        $review->save();
        return redirect()->route('reviews.index')->with('success', 'Review published successfully!');
    }
    public function show(string $id)
    {
        $review = Review::find($id);
        return view('reviews.show')->with('reviews', $review);
    }
    public function edit(string $id)
    {        
        $review = Review::find($id);
        return view('reviews.edit')->with('reviews', $review);
    }
    public function update(Request $request, string $id)
    {
        $review = Review::find($id);
        $input = $request->all();
        $review->update($input);
        return redirect('reviews')->with('flash_message', 'Review updated!'); 
    }
    public function destroy(string $id)
    {        
        Review::destroy($id);
        return redirect('reviews')->with('flash_message', 'Review deleted!');  
    }
}
