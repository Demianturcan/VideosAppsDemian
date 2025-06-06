<x-videos-app-layout>

    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-[95%] mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Series</h1>
                    <a href="{{ route('series.create') }}" class="bg-pink-800 text-white px-4 py-2 rounded-sm hover:bg-pink-700 no-underline inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Create Serie
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($series as $serie)
                        <div class="group bg-white hover:shadow-md shadow rounded-sm overflow-hidden">
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
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-12">
                            No series available.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-videos-app-layout>
