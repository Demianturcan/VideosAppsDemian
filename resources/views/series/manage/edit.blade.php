@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4 text-center">Edit Series</h1>
                <form action="{{ route('series.update', $serie->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="previous_url" value="{{ $previousUrl }}">
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $serie->title) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">{{ old('description', $serie->description) }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-bold mb-2">Image URL</label>
                        <input type="text" id="image" name="image" value="{{ old('image', $serie->image) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                        @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-pink-800 text-white px-4 py-2 rounded hover:bg-pink-700">
                        Update Series
                    </button>
                </form>
                <a href="{{ url()->previous() }}"
                   class="text-center text-gray-500 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded inline-block mt-4">Cancel</a>
            </div>
        </div>
    </section>
@endsection
