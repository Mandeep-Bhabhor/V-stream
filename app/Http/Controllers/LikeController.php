<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like; // assuming you have Like model
use App\Models\Video; 

class LikeController extends Controller
{
    //
    public function like($videoId)
    {
        if (!Auth::check()) {
            // ❌ User is not logged in
            return redirect()->route('login')->with('message', 'Please login first to like videos.');
        }

        $user = Auth::user();

        // ✅ Create a new like
        Like::create([
            'user_id' => $user->id,
            'video_id' => $videoId,
        ]);

        return redirect()->back()->with('success', 'Video liked successfully!');
    }


    public function likedVideos()
{
    $likedVideoIds = auth()->user()->like()->pluck('video_id');

    $likedVideos = Video::whereIn('id', $likedVideoIds)->get();

    return view('trending', compact('likedVideos'));
}
}
