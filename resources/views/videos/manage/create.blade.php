<x-videos-app-layout>

    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="sm:max-w-lg mx-auto bg-white shadow rounded-sm p-6">
                <h1 class="text-2xl font-bold mb-4">Add New Video</h1>
                <form action="{{ route('video.store') }}" method="post" data-qa="form-create-video">
                    @csrf
                    <input type="hidden" name="previous_url" value="{{ $previousUrl }}">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                        <input type="text" name="title" value="{{ old('title', 'Default Title') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-sm p-2"
                               placeholder="Enter video title" data-qa="input-title">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                        <textarea type="text" name="description"
                                  required
                                  class="mt-1 block w-full border border-gray-300 rounded-sm p-2"
                                  placeholder="Enter video description" data-qa="input-description"> {{ old('description', 'Default Description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="url" class="block text-sm font-medium text-gray-700">URL:</label>
                        <input type="url" name="url"
                               value="{{ old('url', 'https://www.youtube.com/embed/eLI8c_NtkBk') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-sm p-2"
                               placeholder="Enter video URL" data-qa="input-url">
                    </div>

                    <div class="mb-4">
                        <label for="series_id" class="block text-gray-700 font-bold mb-2">Series</label>
                        <select id="series_id" name="series_id"
                                class="w-full border-gray-300 rounded-sm shadow focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="">No Series</option>
                            @foreach($series as $serie)
                                <option value="{{ $serie->id }}" {{ old('series_id', $video->series_id ?? '') == $serie->id ? 'selected' : '' }}>
                                    {{ $serie->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-between items-center mt-4">

                        <x-button-gray href="{{ url()->previous() }}" color="gray-200">
                            Return
                        </x-button-gray>

                        <x-button-pink type="submit">
                            Add Video
                        </x-button-pink>
                    </div>
                </form>
            </div>
        </div>
    </section>

</x-videos-app-layout>
