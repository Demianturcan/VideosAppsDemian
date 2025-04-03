@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-2xl font-bold mb-4">User List</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($users as $user)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-4 hover:bg-gray-100 hover:underline cursor-pointer flex items-center"
                                 onclick="window.location='{{ route('user.show', $user->id) }}'">
                                <img class="h-10 w-10 rounded-full object-cover"
                                     src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                <div class="ml-4">
                                    <h2 class="text-lg font-bold text-pink-800">{{ $user->name }}</h2>
                                    <p class="text-gray-700">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
