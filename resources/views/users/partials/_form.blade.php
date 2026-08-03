<div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pt-5">

    <!-- Full Name -->
    <div class="sm:col-span-2">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
            Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                       focus:border-primary-600 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="John Doe" required>
    </div>

    <!-- Email -->
    <div class="w-full">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                       focus:border-primary-600 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="example@mail.com" required>
    </div>

    <!-- Phone -->
    <div class="w-full">
        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                       focus:border-primary-600 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="+62 81234567890" required>
    </div>

    <!-- Password -->
    <div class="w-full">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" name="password" id="password"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                       focus:border-primary-600 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="••••••••" {{ isset($user) ? '' : 'required' }}>
        {{-- Saat edit: password tidak wajib --}}
    </div>

    <!-- Gender -->
    <div class="w-full">
        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
        <select id="gender" name="gender"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 
                       focus:border-primary-500 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option disabled {{ old('gender', $user->gender ?? '') == '' ? 'selected' : '' }}>Choose gender</option>
            <option value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>Female
            </option>
        </select>
    </div>

    {{-- role --}}
    <div class="w-full">
        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Role
        </label>
        <select id="role" name="role"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 
               focus:border-primary-500 block w-full p-2.5 
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
               dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option disabled {{ old('role', isset($user) ? $user->getRoleNames()->first() : null) ? '' : 'selected' }}>
                Choose a role
            </option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}"
                    {{ old('role', isset($user) ? $user->getRoleNames()->first() : null) == $role->name ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>
    </div>


    <!-- Address -->
    <div class="sm:col-span-2">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
        <textarea id="address" name="address" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 
                       focus:ring-primary-500 focus:border-primary-500 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Enter your address">{{ old('address', $user->address ?? '') }}</textarea>
    </div>



</div>
