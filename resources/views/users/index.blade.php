<x-videos-app-layout>

    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-5xl mx-auto">
                <h1 class="text-2xl font-bold mb-4">User List</h1>
                <div class="bg-white shadow rounded-sm overflow-hidden">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-200">
                        <tr>
                            <th class="w-1/6 px-4 py-2 text-left text-gray-700 font-bold">Profile</th>
                            <th class="w-2/6 px-4 py-2 text-left text-gray-700 font-bold">Name</th>
                            <th class="w-3/6 px-4 py-2 text-left text-gray-700 font-bold">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-100 cursor-pointer"
                                onclick="window.location='{{ route('user.show', $user->id) }}'">
                                <td class="px-4 py-2">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                         src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                </td>
                                <td class="px-4 py-2 text-pink-800 font-medium">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-gray-700 font-medium">{{ $user->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</x-videos-app-layout>
