<?php

namespace App\Http\Controllers;

use App\Models\LikesPhoto;
use App\Models\Photo;
use Illuminate\Http\Request;

class LikePhotoController extends Controller
{
    public function like(Request $request)
    {
        $request->validate([
            'photo_id' => ['required', 'exists:photos,id'],
        ]);

        if (!LikesPhoto::where('photo_id', $request->photo_id)->where('user_id', auth()->user()->id)->exists()) {
            LikesPhoto::create([
                'photo_id' => $request->photo_id,
                'user_id' => auth()->user()->id
            ]);
        }
        $data = Photo::with('user')->with('comments')->withCount('likes')->withExists('likedByUser', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->find($request->photo_id);
        return response()->json(['like_count' => $data->likes_count]);
    }

    public function unlike(Request $request)
    {
        $request->validate([
            'photo_id' => ['required', 'exists:photos,id'],
        ]);

        LikesPhoto::where('photo_id', $request->photo_id)->where('user_id', auth()->user()->id)->delete();
        $data = Photo::with('user')->with('comments')->withCount('likes')->find($request->photo_id);


        return response()->json(['like_count' => $data->likes_count]);

    }
}
