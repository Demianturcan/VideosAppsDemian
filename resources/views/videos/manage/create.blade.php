@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="sm:max-w-lg mx-auto bg-white shadow-sm rounded-sm p-6">
                <h1 class="text-2xl font-bold mb-4">Add New Video</h1>
                <form action="{{ route('video.store') }}" method="post" data-qa="form-create-video">
                    @csrf
                    <input type="hidden" name="previous_url" value="{{ $previousUrl }}">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                        <input type="text" name="title" value="{{ old('title', 'Default Title') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-sm p-2"
                               placeholder="Enter video title" data-qa="input-title">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                        <textarea type="text" name="description"
                                  required
                                  class="mt-1 block w-full border border-gray-300 rounded-sm p-2"
                                  placeholder="Enter video description" data-qa="input-description"> {{ old('description', 'Default Description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="url" class="block text-sm font-medium text-gray-700">URL:</label>
                        <input type="url" name="url"
                               value="{{ old('url', 'https://www.youtube.com/embed/eLI8c_NtkBk') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-sm p-2"
                               placeholder="Enter video URL" data-qa="input-url">
                    </div>

                    <div class="mb-4">
                        <label for="series_id" class="block text-gray-700 font-bold mb-2">Series</label>
                        <select id="series_id" name="series_id"
                                class="w-full border-gray-300 rounded-sm shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="">No Series</option>
                            @foreach($series as $serie)
                                <option value="{{ $serie->id }}" {{ old('series_id', $video->series_id ?? '') == $serie->id ? 'selected' : '' }}>
                                    {{ $serie->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-between items-center mt-4">

                        <a href="{{ url()->previous() }}"
                           class="text-gray-500 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-sm inline-block"
                           data-qa="link-return">Return</a>

                        <button type="submit" class="bg-pink-800 text-white px-6 py-2 rounded-sm hover:bg-pink-700"
                                data-qa="button-submit">Add Video
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
