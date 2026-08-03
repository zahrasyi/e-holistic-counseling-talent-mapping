<div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pt-5">

    <!-- Role Name -->
    <div class="sm:col-span-2">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Role Name
        </label>
        <input type="text" name="name" id="name" value="{{ old('name', $role->name ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                      focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 
                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                      dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Admin, Editor, Customer" required>
    </div>

    <!-- Guard Name -->
    {{-- <div class="w-full">
        <label for="guard_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Guard Name
        </label>
        <input type="text" name="guard_name" id="guard_name"
            value="{{ old('guard_name', $role->guard_name ?? 'web') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                      focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 
                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                      dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="web">
    </div> --}}
</div>
