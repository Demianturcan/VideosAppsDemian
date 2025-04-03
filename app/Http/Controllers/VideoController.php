<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Contracts\View\View;

class VideoController extends Controller
{

    public function index(): View
    {
        $videos = Video::all();
        return view('videos.index', ['videos' => $videos]);
    }

    /**
     * Display the specified video.
     *
     * @param Video $video
     * @return View
     */
    public function show(Video $video): View
    {

        $previousUrl = url()->previous();

        return view('videos.show', [
            'video' => $video,
            'previousUrl' => $previousUrl,
        ]);
    }

    /**
     * Display the videos tested by a specific user.
     *
     * @param int $userId
     * @return View
     */
    public function testedBy(int $userId) : View
    {
        $videos = Video::where('tested_by', $userId)->get();

        return view('videos.tested_by', ['videos' => $videos]);
    }
}
