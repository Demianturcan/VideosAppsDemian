<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VideosManageController extends Controller
{
    public function testedby(int $userId): View
    {
        $videos = Video::where('tested_by', $userId)->get();
        return view('videos.manage.tested_by', ['videos' => $videos]);
    }
    public function index() :View
    {
        $videos = Video::all();
        return view('videos.manage.index', ['videos' => $videos]);
    }

    public function create() : View
    {
        return view ('videos.manage.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'previous' => 'nullable|integer|exists:videos,id',
            'next' => 'nullable|integer|exists:videos,id',
            'series_id' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);
        $validated['published_at'] = now();
        Video::create($validated);
        return redirect()->route('videos.manage')->with('success', 'Video created successfully.');
    }

    public function edit(Video $video): View
    {
        return view('videos.manage.edit', compact('video'));
    }

    public function update(Request $request, Video $video): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'previous' => 'nullable|integer|exists:videos,id',
            'next' => 'nullable|integer|exists:videos,id',
            'series_id' => 'required|integer'

        ]);

        $video->update($validated);
        return redirect()->route('videos.manage')->with('success', 'Video updated successfully.');
    }

    public function delete(Video $video)
    {

        return view('videos.manage.delete', compact('video'));
    }

    public function destroy(Video $video): RedirectResponse
    {
        $video->delete();
        return redirect()->route('videos.manage')->with('success', 'Video deleted successfully.');
    }
}


