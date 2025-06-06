<x-videos-app-layout>

    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-3xl mx-auto bg-white shadow rounded-sm overflow-hidden">
                <!-- Video Player -->
                <div class="relative w-full" style="padding-bottom: 56.3%;"> <!-- 4:3 aspect ratio -->
                    <iframe class="absolute w-full h-full" src="{{ $video->url }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                </div>

                <!-- Video Details -->
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $video->title }}</h1>
                            <p class="text-gray-600 mt-2">Published: {{ $video->published_at }}</p>
                        </div>
                        @if(Auth::id() == $video->user_id)
                            <div class="flex space-x-2">
                                <a href="{{ route('videoUser.edit', $video->id) }}" class="bg-pink-800 hover:bg-pink-900 text-white font-bold py-2 px-4 rounded-sm">Edit</a>
                                <a href="{{ route('videoUser.delete', $video->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-sm">Delete</a>
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 leading-relaxed">{{ $video->description }}</p>
                    </div>

                    <!-- Video Navigation -->
                    <div class="flex justify-between items-center mt-8">
                        <a href="{{ $previousUrl }}" class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4">Return</a>
                        @if($video->previous)
                            <a href="{{ route('videos.show', $video->previous) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-sm inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Previous
                            </a>
                        @else
                            <div></div>
                        @endif



                        @if($video->next)
                            <a href="{{ route('videos.show', $video->next) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-sm inline-flex items-center">
                                Next
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <div></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-videos-app-layout>
