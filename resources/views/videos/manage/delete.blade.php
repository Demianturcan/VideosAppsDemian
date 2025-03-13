@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4 text-center text-red-600">Delete Video</h1>
                <p class="text-center text-gray-700 mb-6">Are you sure you want to delete <strong>"{{ $video->title }}
                        "</strong>?</p>
                <form action="{{ route('video.destroy', $video->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 mb-4">
                        Delete Video
                    </button>
                </form>
                <a href="/videos/manage"
                   class="text-center text-gray-500 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded inline-block">Cancel</a>
            </div>
        </div>
    </section>
@endsection
