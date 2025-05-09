<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SeriesManageController extends Controller
{


    /**
     * Display a listing of the series.
     */
    public function index()
    {
        $series = Serie::all();

        return view('series.manage.index', compact('series'));
    }

    public function create() : View
    {
        return view ('series.manage.create');
    }

    /**
     * Store a newly created series in storage.
     */
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

        Serie::create($validated);

        return redirect()->route('series.manage')->with('success', 'Series created successfully.');
    }

    /**
     * Show the form for editing the specified series.
     */
    public function edit(Serie $serie)
    {
        $previousUrl = url()->previous();
        return view('series.manage.edit', compact('serie', 'previousUrl'));
    }

    /**
     * Update the specified series in storage.
     */
    public function update(Request $request, Serie $serie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $serie->update($validated);

        return redirect()->route('series.manage')->with('success', 'Series updated successfully.');
    }

    /**
     * Show the confirmation page for deleting the specified series.
     */
    public function delete(Serie $serie)
    {
        $previousUrl = url()->previous();
        return view('series.manage.delete', compact('serie', 'previousUrl'));
    }

    /**
     * Remove the specified series from storage.
     */
    public function destroy(Request $request, Serie $serie)
    {
        if ($request->has('delete_videos') && $request->input('delete_videos') == 1) {
            $serie->videos()->delete();
        } else {

            $serie->videos()->update(['series_id' => null]);
        }
        $serie->delete();

        return redirect()->route('series.manage')->with('success', 'Series deleted successfully.');
    }

    /**
     * Placeholder for testedby logic.
     */
    public function testedby()
    {

    }
}
