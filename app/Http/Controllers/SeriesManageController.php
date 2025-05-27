<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
            'previous_url' => 'nullable|string',
        ]);
        $user = auth()->user();
        $validated['user_id'] =  $user->id;
        $validated['user_name'] = $user->name;
        $validated['user_photo_url'] = $user->profile_photo_url;
        $validated['published_at'] = now();
        $previousUrl = $validated['previous_url'] ?? route('series');
        Serie::create($validated);

        return redirect($previousUrl)->with('success', 'Series created successfully.');
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

        if (($serie->user_id !== auth()->user()->id) && (!auth()->user()->can('manage-series'))) {
            return redirect()->route('series')->with('error', 'You are not authorized to update this series.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'previous_url' => 'nullable|string',

        ]);

        $previousUrl = $validated['previous_url'] ?? route('videos.manage');
        $serie->update($validated);

        return redirect($previousUrl)->with('success', 'Series updated successfully.');
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
        if (($serie->user_id !== auth()->user()->id) && (!auth()->user()->can('manage-series'))) {
            return redirect()->route('series')->with('error', 'You are not authorized to delete this series.');
        }
        if ($request->has('delete_videos') && $request->input('delete_videos') == 1) {
            $serie->videos()->delete();
        } else {
            $serie->videos()->update(['series_id' => null]);
        }

        $validated = $request->validate([
            'previous_url' => 'nullable|string'
        ]);

        $serie->delete();

        $previousUrl = $validated['previous_url'] ?? route('series.manage');
        $client = new Client();
        try {
            $response = $client->request('GET', $previousUrl);
            if ($response->getStatusCode() == 200) {
                return redirect($previousUrl)->with('success', 'Series deleted successfully.');
            } else {
                return redirect()->route('series')->with('success', 'Series deleted successfully.');
            }
        } catch (GuzzleException $e) {
            return redirect()->route('series')->with('success', 'Series deleted successfully.');
        }
    }

    /**
     * Placeholder for testedby logic.
     */
    public function testedby()
    {

    }
}
