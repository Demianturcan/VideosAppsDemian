@extends('layouts.videosapp')
@section('content')
    <section class="flex flex-col min-h-screen bg-gray-100 p-6">
        <div class="flex-grow">
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Add New User</h1>
                <form action="{{ route('user.store') }}" method="post" data-qa="form-create-user">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" name="name" value="{{ old('name', 'User') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                               placeholder="Enter user name" data-qa="input-name">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" name="email" value="{{ old('email', 'newUser@videosapp.com') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                               placeholder="Enter user email" data-qa="input-email">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                        <input type="password" name="password" required
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                               placeholder="Enter user password" value="{{ old('', '123456789') }}" data-qa="input-password">
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                        <input type="password" name="password_confirmation" required
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                               placeholder="Confirm user password" value="{{ old('', '123456789') }}" data-qa="input-password-confirmation">
                    </div>

                    <button type="submit" class="w-full bg-pink-800 text-white px-4 py-2 rounded hover:bg-pink-700"
                            data-qa="button-submit">Add User
                    </button>
                </form>
                <a href="{{ route('users.manage') }}"
                   class="text-gray-500 mt-4 no-underline bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded inline-block"
                   data-qa="link-return">Return</a>
            </div>
        </div>
    </section>
@endsection
