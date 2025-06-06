<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
use App\Models\Serie;
use App\Models\Video;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
        $previousUrl = url()->previous();
        $series = Serie::all();
        return view('videos.manage.create', ['series' => $series, 'previousUrl' => $previousUrl]);
    }
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'previous' => 'nullable|integer|exists:videos,id',
            'next' => 'nullable|integer|exists:videos,id',
            'series_id' => 'nullable|integer',
            'previous_url' => 'nullable|url',
        ]);
        $validated['user_id'] = auth()->user()->id;
        $validated['published_at'] = now();
        $previousUrl = $validated['previous_url'] ?? route('videos');
        try {
            $video = Video::create($validated);
            event(new VideoCreated($video));
            return redirect($previousUrl)->with('success', 'Video "' . $video->title . '" created succesfully!');
        } catch (\Exception $e) {
            return redirect($previousUrl)->with('error', 'There was an error creating the video. ' . $e->getMessage());
        }
    }

    public function edit(Video $video): View
    {
        $previousUrl = url()->previous();
        $series = Serie::all();
        return view('videos.manage.edit', ['video' => $video, 'series' => $series, 'previousUrl' => $previousUrl]);
    }

    public function update(Request $request, Video $video): RedirectResponse
    {

        if (($video->user_id !== auth()->user()->id) && (!auth()->user()->can('manage-videos'))) {
            return redirect()->route('videos')->with('error', 'You are not authorized to update this video.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'previous' => 'nullable|integer|exists:videos,id',
            'next' => 'nullable|integer|exists:videos,id',
            'series_id' => 'nullable|integer',
            'previous_url' => 'nullable|url'
        ]);
        $previousUrl = $validated['previous_url'] ?? route('videos.manage');
        try {
            $video->update($validated);
            return redirect($previousUrl)->with('success', 'Video "' . $video->title . '" updated successfully!');
        } catch (\Exception $e) {
            return redirect($previousUrl)->with('error', 'There was an error updating the video. ' . $e->getMessage());
        }
    }

    public function delete(Video $video)
    {
        $previousUrl = url()->previous();
        return view('videos.manage.delete', ['video' => $video, 'previousUrl' => $previousUrl]);
    }

    public function destroy(Request $request, Video $video): RedirectResponse
    {
        if (($video->user_id !== auth()->user()->id) && (!auth()->user()->can('manage-videos'))) {
            return redirect()->route('videos')->with('error', 'You are not authorized to update this video.');
        }

        $validated = $request->validate([
            'previous_url' => 'nullable|string'
        ]);

        $video->delete();

        $previousUrl = $validated['previous_url'] ?? route('videos.manage');
        $client = new Client();
        try {
            $response = $client->request('GET', $previousUrl);
            if ($response->getStatusCode() == 200) {
                return redirect($previousUrl)->with('success', 'Video deleted successfully.');
            } else {
                return redirect()->route('videos')->with('success', 'Video deleted successfully.');
            }
        } catch (GuzzleException $e) {
            return redirect()->route('videos')->with('success', 'Video deleted successfully.');
        }
    }
}


