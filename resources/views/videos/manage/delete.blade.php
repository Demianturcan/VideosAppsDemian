@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-md mx-auto bg-white shadow-sm rounded-sm p-6">
                <h1 class="text-2xl font-bold mb-4 text-center text-red-600">Delete Video</h1>
                <p class="text-center text-gray-700 mb-6">Are you sure you want to delete the video <strong>"{{ $video->title }}"</strong>?</p>
                <form action="{{ route('video.destroy', $video->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="previous_url" value="{{ $previousUrl }}">
                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ url()->previous() }}"
                           class="text-gray-500 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-sm inline-block">Cancel</a>
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-sm hover:bg-red-700">
                            Delete Video
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
