<x-videos-app-layout>
    <section class="flex flex-col min-h-screen bg-gray-100 p-4 sm:p-6">
        <div class="flex-grow">
            <div class="max-w-[95%] mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Videos</h1>
                    <x-button-pink href="{{ route('video.create') }}" icon="true" color="pink-800">
                        Create Video
                    </x-button-pink>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
                    @foreach($videos as $video)
                        <div class="group relative bg-white shadow hover:shadow-md rounded-sm overflow-hidden transition-transform duration-200">
                            <a href="{{ route('video.show', $video->id) }}" class="block">
                                <div class="relative">
                                    <iframe class="w-full h-64 pointer-events-none" src="{{ $video->url }}?controls=0&modestbranding=1&showinfo=0&rel=0" frameborder="0"
                                            allowfullscreen></iframe>
                                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-200"></div>
                                </div>
                                <div class="p-6 hover:bg-gray-100">
                                    <h2 class="text-xl font-bold text-pink-800 group-hover:text-pink-600 transition-colors duration-100">{{ $video->title }}</h2>
                                    <p class="text-gray-700 group-hover:text-blue-500 transition-colors duration-100 mt-2">{{ $video->description }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</x-videos-app-layout>
