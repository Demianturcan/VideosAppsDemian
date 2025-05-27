@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Add New Series</h1>
                <form action="{{ route('series.store') }}" method="post" data-qa="form-create-series">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="text" name="title" value="{{ old('title', 'Default Title') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-sm p-2"
                               placeholder="Enter series title" data-qa="input-title">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                        <textarea name="description" rows="3"
                                  class="mt-1 block w-full border border-gray-300 rounded-sm p-2"
                                  placeholder="Enter series description" data-qa="input-description">{{ old('description', 'Default Description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image URL:</label>
                        <input type="url" name="image" value="{{ old('image', 'https://placehold.co/600x400/firebrick/black') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-sm p-2"
                               placeholder="Enter image URL" data-qa="input-image">
                    </div>

                    <button type="submit" class="w-full bg-pink-800 text-white px-4 py-2 rounded hover:bg-pink-700"
                            data-qa="button-submit">Add Series
                    </button>
                </form>
                <a href="{{ url()->previous() }}"
                   class="text-gray-500 mt-4 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded inline-block"
                   data-qa="link-return">Return</a>
            </div>
        </div>
    </section>
@endsection
