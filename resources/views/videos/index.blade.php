@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-2xl font-bold mb-4">Video List</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($videos as $video)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <iframe class="w-full h-48" src="{{ $video->url }}" frameborder="0"
                                    allowfullscreen></iframe>
                            <div class="p-4 hover:bg-gray-100 hover:underline cursor-pointer"
                                 onclick="window.location='{{ route('video.show', $video->id) }}'">
                                <h2 class="text-lg font-bold text-pink-800 ">{{ $video->title }}</h2>
                                <p class="text-gray-700 ">{{ $video->description }}</p>
                                {{--                                <a href="{{ route('video.show', $video->id) }}" class="text-pink-800 hover:underline mt-2 block">View Details</a>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

