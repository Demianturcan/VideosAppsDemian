<x-videos-app-layout>

    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4 text-center text-red-600">Delete Series</h1>
                <p class="text-center text-gray-700 mb-6">Are you sure you want to delete the series <strong>"{{ $serie->title }}"</strong>?</p>
                <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="previous_url" value="{{ $previousUrl }}">
                    <div class="mb-4">
                        <label class="inline-flex items-center px-4">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-red-600" name="delete_videos" value="1">
                            <span class="ml-2 text-gray-700">Delete associated videos</span>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 mb-4">
                        Delete Series
                    </button>
                </form>
                <a href="{{ url()->previous() }}"
                   class="text-center text-gray-500 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded inline-block">Cancel</a>
            </div>
        </div>
    </section>

</x-videos-app-layout>
