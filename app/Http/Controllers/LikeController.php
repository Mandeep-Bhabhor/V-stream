<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like; // assuming you have Like model
use App\Models\Video; 

class LikeController extends Controller
{
    //
    public function toggle($videoId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        $like = Like::where('user_id', $user->id)
                    ->where('video_id', $videoId)
                    ->first();

        if ($like) {
            // User already liked, so unlike
            $like->delete();
            return response()->json(['liked' => false]);
        } else {
            // User has not liked yet, so like
            Like::create([
                'user_id' => $user->id,
                'video_id' => $videoId,
            ]);
            return response()->json(['liked' => true]);
        }
    }


    public function likedVideos()
{
    $likedVideoIds = auth()->user()->like()->pluck('video_id');

    $likedVideos = Video::whereIn('id', $likedVideoIds)->get();

    return view('trending', compact('likedVideos'));
}
}
