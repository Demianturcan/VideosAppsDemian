<x-videos-app-layout>

    <section class="flex flex-col min-h-screen pt-12 bg-gray-100 sm:pt-16">
        <div class="flex-grow">
            <div class="max-w-4xl mx-auto bg-white shadow-md rounded-sm p-6 overflow-x-scroll">
                <h1 class="text-3xl font-bold mb-4">Videos</h1>
                <a href="{{ route('video.create') }}"
                   class="bg-pink-800 text-white px-4 py-2 rounded-sm hover:bg-pink-700 no-underline mb-4 inline-block">Add
                    New Video</a>
                <!-- Table for desktop -->
                <div class="overflow-x-auto hidden sm:block">
                    <table class="min-w-full mt-4 border border-gray-300">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Title</th>
                            <th class="py-3 px-6 text-left">Description</th>
                            <th class="py-3 px-6 text-left">Published At</th>
                            <th class="py-3 px-6 text-center"></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @forelse ($videos as $video)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer"
                                onclick="window.location='{{ route('video.show', $video->id) }}'">
                                <td class="py-3 px-6 text-left">{{ $video->title }}</td>
                                <td class="py-3 px-6 text-left">{{ $video->description }}</td>
                                <td class="py-3 px-6 text-left">{{ $video->published_at }}</td>
                                <td class="py-3 px-2 text-center flex flex-col sm:flex-row sm:justify-center">
                                    <a href="{{ route('video.delete', $video->id) }}"
                                       class="text-white bg-red-500 hover:bg-red-700 mb-1.5 sm:mb-0 sm:mr-4 px-4 py-2 rounded-sm no-underline">Delete</a>
                                    <a href="{{ route('video.edit', $video->id) }}"
                                       class="text-white bg-pink-800 hover:bg-pink-700 mb-1.5 sm:mb-0 sm:mr-4 px-4 py-2 rounded-sm no-underline">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-3 px-6 text-center">No videos available.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="sm:hidden flex flex-col gap-4 mt-4">
                    @forelse ($videos as $video)
                        <div class="bg-white shadow rounded-sm p-4 flex flex-col gap-2">
                            <div>
                                <span class="font-bold text-pink-800">{{ $video->title }}</span>
                            </div>
                            <div class="text-gray-700">{{ $video->description }}</div>
                            <div class="text-xs text-gray-500">Published: {{ $video->published_at }}</div>
                            <div class="flex gap-2 mt-2">
                                <a href="{{ route('video.delete', $video->id) }}"
                                   class="text-white bg-red-500 hover:bg-red-700 px-3 py-1 rounded-sm no-underline text-sm">Delete</a>
                                <a href="{{ route('video.edit', $video->id) }}"
                                   class="text-white bg-pink-800 hover:bg-pink-700 px-3 py-1 rounded-sm no-underline text-sm">Edit</a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500">No videos available.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

</x-videos-app-layout>
