<x-videos-app-layout>
    <section class="flex flex-col min-h-screen pt-12 bg-gray-100 sm:pt-16">
        <div class="flex-grow">
            <div class="max-w-4xl mx-auto bg-white shadow rounded-sm p-6">
                <h1 class="text-3xl font-bold mb-4">Series</h1>
                <a href="{{ route('series.create') }}"
                   class="bg-pink-800 text-white px-4 py-2 rounded hover:bg-pink-700 no-underline mb-4 inline-block">Add New Series</a>

                <div class="overflow-x-auto hidden sm:block">
                    <table class="min-w-full mt-4 border border-gray-300">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Title</th>
                            <th class="py-3 px-6 text-left">Description</th>
                            <th class="py-3 px-6 text-left">User</th>
                            <th class="py-3 px-6 text-left">Published At</th>
                            <th class="py-3 px-6 text-center"></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @forelse ($series as $serie)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer"
                                onclick="window.location='{{ route('series.show', $serie->id) }}'">
                                <td class="py-3 px-6 text-left">{{ $serie->title }}</td>
                                <td class="py-3 px-6 text-left">{{ $serie->description }}</td>
                                <td class="py-3 px-6 text-left">{{ $serie->user_name }}</td>
                                <td class="py-3 px-6 text-left">{{ $serie->published_at }}</td>
                                <td class="py-3 px-2 text-center flex flex-col sm:flex-row sm:justify-center">
                                    <a href="{{ route('series.delete', $serie->id) }}"
                                       class="text-white bg-red-500 hover:bg-red-700 mb-1.5 sm:mb-0 sm:mr-4 px-4 py-2 rounded no-underline">Delete</a>
                                    <a href="{{ route('series.edit', $serie->id) }}"
                                       class="text-white bg-pink-800 hover:bg-pink-700 mb-1.5 sm:mb-0 sm:mr-4 px-4 py-2 rounded no-underline">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-3 px-6 text-center">No series available.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>


                <div class="sm:hidden flex flex-col gap-4 mt-4">
                    @forelse ($series as $serie)
                        <div class="bg-white shadow rounded-sm p-4 flex flex-col gap-2">
                            <div>
                                <span class="font-bold text-pink-800">{{ $serie->title }}</span>
                            </div>
                            <div class="text-gray-700">{{ $serie->description }}</div>
                            <div class="text-xs text-gray-500">User: {{ $serie->user_name }}</div>
                            <div class="text-xs text-gray-500">Published: {{ $serie->published_at }}</div>
                            <div class="flex gap-2 mt-2">
                                <a href="{{ route('series.delete', $serie->id) }}"
                                   class="text-white bg-red-500 hover:bg-red-700 px-3 py-1 rounded-sm no-underline text-sm">Delete</a>
                                <a href="{{ route('series.edit', $serie->id) }}"
                                   class="text-white bg-pink-800 hover:bg-pink-700 px-3 py-1 rounded-sm no-underline text-sm">Edit</a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500">No series available.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-videos-app-layout>
