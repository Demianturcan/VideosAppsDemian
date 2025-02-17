<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Contracts\View\View;

class VideoController extends Controller
{

    public function index(): View
    {
        return view('videos.manage');
    }

    private ?string $view = null;

    /**
     * Display the specified video.
     *
     * @param Video $video
     * @return View
     */
    public function show(Video $video): View
    {
        return view('videos.show', ['video' => $video]);
    }

    /**
     * Display the videos tested by a specific user.
     *
     * @param int $userId
     * @return View
     */
    public function testedBy(int $userId): View
    {
        $this->view = 'videos.tested_by';
        $videos = Video::where('tested_by', $userId)->get();
        return view($this->view, ['videos' => $videos]);
    }
}
