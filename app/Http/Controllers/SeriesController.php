<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    public function index(): View
    {
        $series = Serie::all();
        return view('series.index', ['series' => $series]);
    }


    public function show(Serie $serie) : View
    {
        $videos = Video::where('series_id', $serie->id)->get();
        return view('series.show', ['serie' => $serie, 'videos' => $videos]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $user = auth()->user();
        $validated['user_name'] = $user->name;
        $validated['user_photo_url'] = $user->profile_photo_url;
        $validated['published_at'] = now();

        $serie = Serie::create($validated);

        return redirect()->route('series.show', $serie->id)->with('success', 'Series created successfully.');
    }

    public function edit(Serie $serie)
    {
        if ($serie-> user_id !== Auth::id()) {
            return redirect()->route('series')->with('error', 'You are not authorized to edit this series.');
        }

        $previousUrl = url()->previous();
        return view('series.manage.edit',  ['serie' => $serie, 'previousUrl' => $previousUrl]);

    }

    public function update(Request $request, Serie $serie)
    {
        if ($serie->user_id !== Auth::id()) {
            return redirect()->route('series')->with('error', 'You are not authorized to update this series.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $serie->update($validated);

        return redirect()->route('series.show', $serie->id)->with('success', 'Series updated successfully.');
    }

    public function delete(Serie $serie)
    {
        if ($serie->user_id !== Auth::id()) {
            return redirect()->route('series')->with('error', 'You are not authorized to delete this series.');
        }
        $previousUrl = session('previousUrl', route('series')); // Default to 'series' route if no previous URL in session
        session()->forget('previousUrl'); // Remove the variable from the session

        return view('series.manage.delete', ['serie' => $serie, 'previousUrl' => $previousUrl]);

    }

}






















