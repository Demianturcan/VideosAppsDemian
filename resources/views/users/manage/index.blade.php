<x-videos-app-layout>

    <section class="flex flex-col min-h-screen pt-12 bg-gray-100 sm:pt-16">
        <div class="flex-grow">
            <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 overflow-x-scroll">
                <h1 class="text-3xl font-bold mb-4">Users</h1>
                <a href="{{ route('user.create') }}"
                   class="bg-pink-800 text-white px-4 py-2 rounded hover:bg-pink-700 no-underline mb-4 inline-block">Add
                    New User</a>
                <div class="overflow-x-auto">
                    <table class="min-w-full mt-4 border border-gray-300">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-center"></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @forelse ($users as $user)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer"
                                onclick="window.location='{{ route('user.show', $user->id) }}'">
                                <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                                <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                                <td class="py-3 px-2 text-center flex flex-col sm:flex-row sm:justify-center">
                                    <a href="{{ route('user.delete', $user->id) }}"
                                       class="text-white bg-red-500 hover:bg-red-700 mb-1.5 sm:mb-0 sm:mr-4 px-4 py-2 rounded no-underline">Delete</a>
                                    <a href="{{ route('user.edit', $user->id) }}"
                                       class="text-white bg-pink-800 hover:bg-pink-700 mb-1.5 sm:mb-0 sm:mr-4 px-4 py-2 rounded no-underline">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-3 px-6 text-center">No users available.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</x-videos-app-layout>
