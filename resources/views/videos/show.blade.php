@extends('layouts.videos-app-layout')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Video Details</h1>

                <div class="mb-4">
                    <strong class="block text-gray-700">ID:</strong>
                    <p class="mt-1">{{ $video->id }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-700">Title:</strong>
                    <p class="mt-1">{{ $video->title }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-700">Description:</strong>
                    <p class="mt-1">{{ $video->description }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-700">URL:</strong>
                    <p class="mt-1">{{ $video->url }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-700">Published At:</strong>
                    <p class="mt-1">{{ $video->published_at }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-700">Previous Video ID:</strong>
                    <p class="mt-1">{{ $video->previous }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-700">Next Video ID:</strong>
                    <p class="mt-1">{{ $video->next }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-700">Series ID:</strong>
                    <p class="mt-1">{{ $video->series_id }}</p>
                </div>

                <a href="/videos" class="text-gray-500 mt-4 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded inline-block">Return</a>
                {{--                <a href="{{ route('videos.edit', $video->id) }}" class="text-gray-50 mt-4 no-underline bg-pink-800 hover:bg-pink-700 px-4 py-2 rounded inline-block">Edit</a>--}}

            </div>
        </div>
    </section>
@endsection
