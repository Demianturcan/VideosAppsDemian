@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-5xl mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-3xl font-bold text-pink-800">{{ $serie->title }}</h1>
                    @if(Auth::check() && Auth::user()->id == $serie->user_id)
                        <div class="flex space-x-2">
                            <a href="{{ route('seriesUser.edit', $serie->id) }}" class="bg-pink-800 hover:bg-pink-900 text-white font-bold py-2 px-4 rounded-sm">Edit</a>
                            <a href="{{ route('seriesUser.delete', $serie->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-sm">Delete</a>
                        </div>
                    @endif
                </div>
                <p class="text-gray-700 mb-6">{{ $serie->description }}</p>
                @if($serie->image)
                    <img src="{{ $serie->image }}" alt="{{ $serie->title }}" class="w-full h-64 object-cover mb-6">
                @endif
                <p class="text-sm text-gray-500 mb-6">Created by: {{ $serie->user_name }}</p>

                <h2 class="text-2xl font-bold mb-4">Videos in this Series</h2>
                @if($videos->isEmpty())
                    <p class="text-gray-700">No videos are associated with this series.</p>
                @else
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700 font-bold">Title</th>
                                <th class="px-4 py-2 text-left text-gray-700 font-bold">Description</th>
                                <th class="px-4 py-2 text-left text-gray-700 font-bold">URL</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($videos as $video)
                                <tr class="border-b hover:bg-gray-100 cursor-pointer"
                                    onclick="window.location='{{ route('video.show', $video->id) }}'">
                                    <td class="px-4 py-2 text-pink-800 font-bold">{{ $video->title }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $video->description }}</td>
                                    <td class="px-4 py-2 text-blue-600">
                                        <a href="{{ $video->url }}" target="_blank" class="hover:underline">Watch</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <a href="{{ route('series') }}"
                   class="text-gray-500 mt-6 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded inline-block">Back to Series List</a>
            </div>
        </div>
    </section>
@endsection
