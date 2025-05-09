<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
}
