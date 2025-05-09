@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-2xl font-bold mb-4">Series List</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($series as $serie)
                        <div class="group bg-white hover:shadow-md shadow-sm rounded-lg overflow-hidden">
                            <div class="p-4 hover:bg-gray-50 cursor-pointer"
                                 onclick="window.location='{{ route('series.show', $serie->id) }}'">
                                <h2 class="text-lg font-bold text-pink-800 group-hover:text-pink-600 transition-colors duration-100">{{ $serie->title }}</h2>
                                <p class="text-gray-700 group-hover:text-blue-500 transition-colors duration-100">{{ $serie->description }}</p>
                                @if($serie->image)
                                    <img src="{{ $serie->image }}" alt="{{ $serie->title }}" class="w-full h-48 object-cover mt-2">
                                @endif
                                <p class="text-sm text-gray-500 mt-2 group-hover:text-blue-500 transition-colors duration-100">Created by: {{ $serie->user_name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
