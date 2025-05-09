@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-2xl font-bold mb-4">Video List</h1>
                <a href="{{ route('video.create') }}" class="bg-pink-800 text-white px-4 py-2 rounded-sm hover:bg-pink-700 no-underline mb-4 inline-block">Create Video</a>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($videos as $video)
                        <div class="group relative bg-white shadow-sm hover:shadow-md rounded-sm overflow-hidden transition-transform duration-200 hover:scale-105">
                            <a href="{{ route('video.show', $video->id) }}" class="block">
                                <div class="relative">
                                    <iframe class="w-full h-48 pointer-events-none" src="{{ $video->url }}?controls=0&modestbranding=1&showinfo=0&rel=0" frameborder="0"
                                            allowfullscreen></iframe>
                                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-200"></div>
                                </div>
                                <div class="p-4 hover:bg-gray-100">
                                    <h2 class="text-lg font-bold text-pink-800 group-hover:text-pink-600 transition-colors duration-100">{{ $video->title }}</h2>
                                    <p class="text-gray-700 group-hover:text-blue-500 transition-colors duration-100">{{ $video->description }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
