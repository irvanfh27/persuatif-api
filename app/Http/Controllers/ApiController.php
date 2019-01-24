<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dawson\Youtube\Facades\Youtube;

class ApiController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            ]);
        $fullPathToVideo = $request->file('video');
        $video = Youtube::upload($fullPathToVideo, [
                'title' => $request->title,
                'description' => $request->description,
                // 'tags' => ['foo', 'bar', 'baz'],
                ]);

        return response()->json(
                    [
                        'message' => 'success',
                        'data' => [
                            'id' => $video->getVideoId(),
                            'link' => 'https://www.youtube.com/watch?v='.$video->getVideoId(),
                        ],
                    ], 200);
    }
}
