<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{

    public function index(): View
    {
        $videos = Video::all();
        return view('videos.index', ['videos' => $videos]);
    }


    public function show(Video $video): View
    {

        $previousUrl = url()->previous();
        session(['previousUrl' => $previousUrl]);

        return view('videos.show', [
            'video' => $video,
            'previousUrl' => $previousUrl,
        ]);
    }

    public function edit(Video $video)
    {
        $previousUrl = url()->previous();
        if ($video->user_id !== Auth::id()) {
            return redirect()->route('videos')->with('error', 'You are not authorized to edit this video.');
        }
        $series = Serie::all();
        return view('videos.manage.edit', ['video' => $video, 'series' => $series, 'previousUrl' => $previousUrl]);
    }



    public function delete(Video $video)
    {

        if ($video->user_id !== Auth::id()) {
            return redirect()->route('videos')->with('error', 'You are not authorized to delete this video.');
        }
        $previousUrl = session('previousUrl', route('videos')); // Default to 'videos' route if no previous URL in session
        session()->forget('previousUrl'); // Remove the variable from the session

        return view('videos.manage.delete', ['video' => $video, 'previousUrl' => $previousUrl]);
    }


    public function testedBy(int $userId) : View
    {
        $videos = Video::where('tested_by', $userId)->get();

        return view('videos.tested_by', ['videos' => $videos]);
    }
}










