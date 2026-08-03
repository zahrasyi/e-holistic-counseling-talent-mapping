<x-layouts.app>
    <x-partials.header title="Edit My Profile" description="Update your personal information here." />

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg" role="alert">
            <div class="font-bold">Oops! Ada beberapa masalah:</div>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <x-partials.alert type="error" :message="session('error')" />
    @elseif (session('success'))
        <x-partials.alert type="success" :message="session('success')" />
    @elseif (session('warning'))
        <x-partials.alert type="warning" :message="session('warning')" />
    @elseif (session('info'))
        <x-partials.alert type="info" :message="session('info')" />
    @endif

    <div class="mt-8">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 space-y-8">

            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Account Profile</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update name, email and your password here.</p>

                @if (session('success_account'))
                    <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg" role="alert">
                        {{ session('success_account') }}
                    </div>
                @endif

                <form action="{{ route('profile.update.account') }}" method="POST" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                required
                                class="mt-1 block w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                required
                                class="mt-1 block w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        </div>
                    </div>

                    <p
                        class="text-sm text-gray-500 dark:text-gray-400 pt-4 border-t border-gray-200 dark:border-gray-700">
                        Blank the password if the password wasn't change</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New
                                Password</label>
                            <input type="password" id="password" name="password"
                                class="mt-1 block w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password
                                Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="mt-1 block w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Save Account Change
                        </button>
                    </div>
                </form>
            </div>

            @if (Auth::user()->hasRole('konselor'))
                <hr class="border-gray-200 dark:border-gray-700">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Counselor Detail</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update your professional bio here.
                    </p>

                    @if (session('success_counselor'))
                        <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg" role="alert">
                            {{ session('success_counselor') }}
                        </div>
                    @endif

                    @if ($errors->any() && !$errors->has('bio') && !$errors->has('education.*') && !$errors->has('profile_photo'))
                        <div class="mt-4 p-4 bg-red-100 text-red-800 rounded-lg" role="alert">
                            <div class="font-bold">Oops! There's is trouble:</div>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('counselor.profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                            <div>
                                <label for="bio"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Biography</label>
                                <textarea id="bio" name="bio" rows="6"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ old('bio', optional($user->counselor)->bio) }}</textarea>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Profil Picture</label>
                                <div class="mt-2 flex items-center space-x-6">
                                    <div class="shrink-0">
                                        <img id="photo-preview" class="h-24 w-24 object-cover rounded-full"
                                            src="{{ optional($user->counselor)->profile_photo_path ? Storage::url($user->counselor->profile_photo_path) : 'https://www.gravatar.com/avatar/?d=mp&s=128' }}"
                                            alt="Current profile photo">
                                    </div>
                                    <label class="block">
                                        <span class="sr-only">Choose picture</span>
                                        <input type="file" name="profile_photo" id="profile_photo_input"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:text-gray-400 dark:file:bg-blue-900 dark:file:text-blue-200 dark:hover:file:bg-blue-800" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Education History</label>
                            <div id="education-container" class="mt-2 space-y-4">
                                @forelse (old('education', optional($user->counselor)->education_history ?? []) as $index => $edu)
                                    <div class="education-entry flex items-center space-x-2">
                                        <input type="text" name="education[{{ $index }}][gelar]"
                                            placeholder="Gelar (e.g., S.Psi.)" value="{{ $edu['gelar'] ?? '' }}"
                                            class="block w-1/3 p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <input type="text" name="education[{{ $index }}][universitas]"
                                            placeholder="Nama Universitas" value="{{ $edu['universitas'] ?? '' }}"
                                            class="block flex-1 p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <button type="button"
                                            class="remove-education p-2 text-red-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                @empty
                                    <div class="education-entry flex items-center space-x-2">
                                        <input type="text" name="education[0][gelar]"
                                            placeholder="Gelar (e.g., S.Psi.)" class="block w-1/3 p-2.5 ...">
                                        <input type="text" name="education[0][universitas]"
                                            placeholder="Nama Universitas" class="block flex-1 p-2.5 ...">
                                        <button type="button"
                                            class="remove-education p-2 text-red-500 ...">...</button>
                                    </div>
                                @endforelse
                            </div>
                            <button type="button" id="add-education"
                                class="mt-4 px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">+
                                Add History</button>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Counselor Detail
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

</x-layouts.app>
