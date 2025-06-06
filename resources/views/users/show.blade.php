<x-videos-app-layout>

    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">User Details</h1>

                <div class="mb-4">
                    <strong class="block text-gray-700">Name:</strong>
                    <p class="mt-1">{{ $user->name }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-700">Email:</strong>
                    <p class="mt-1">{{ $user->email }}</p>
                </div>

                <h2 class="text-xl font-bold mt-6 mb-4">Videos</h2>
                @if($videos->isEmpty())
                    <p class="text-gray-700">This user has no videos.</p>
                @else
                    <ul>
                        @foreach($videos as $video)
                            <li class="mb-2">
                                <a href="{{ route('video.show', $video->id) }}" class="text-blue-500 hover:underline">
                                    {{ $video->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <a href="{{ url()->previous() }}"
                   class="text-gray-500 mt-4 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded inline-block">Return</a>
            </div>
        </div>
    </section>

</x-videos-app-layout>
