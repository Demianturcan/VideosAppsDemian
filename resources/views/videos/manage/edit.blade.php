@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Edit Video</h1>
                <form action="{{ route('video.update', $video->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                        <input type="text" name="title" value="{{ old('title', $video->title) }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                               placeholder="Enter video title">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                        <input type="text" name="description" value="{{ old('description', $video->description) }}"
                               required
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                               placeholder="Enter video description">
                    </div>

                    <div class="mb-4">
                        <label for="url" class="block text-sm font-medium text-gray-700">URL:</label>
                        <input type="url" name="url" value="{{ old('url', $video->url) }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                               placeholder="Enter video URL">
                    </div>

                    <div class="mb-4">
                        <label for="series_id" class="block text-sm font-medium text-gray-700">Series ID:</label>
                        <input type="number" name="series_id" value="{{ old('series_id', $video->series_id) }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                               placeholder="Enter series ID">
                    </div>

                    <button type="submit" class="w-full bg-pink-800 text-white px-4 py-2 rounded hover:bg-pink-700">
                        Update Video
                    </button>
                </form>
                <a href="/videos/manage"
                   class="text-gray-500 mt-4 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded inline-block">Return</a>
            </div>
        </div>
    </section>
@endsection
