<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class VideoController extends Controller
{
    /**
     * Display the specified video.
     *
     * @param string $id
     * @return Factory|View|Application
     */
    public function show(string $id): Factory|View|Application
    {
        $video = Video::findOrFail($id);
        return view('videos/show', ['video' => $video]);
    }

    /**
     * Display the videos tested by a specific user.
     *
     * @param int $userId
     * @return Application|Factory|View
     */
    public function testedBy(int $userId): Application|Factory|View
    {
        $videos = Video::where('tested_by', $userId)->get();
        return view('videos.tested_by', compact('videos'));
    }
}


