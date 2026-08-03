<div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pt-5">

    <!-- Name -->
    <div class="sm:col-span-2">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name', $counselingType->name ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                   focus:border-primary-600 block w-full p-2.5 
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                   dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Faktor psikologis" required>
    </div>

    <!-- Description -->
    <div class="sm:col-span-2">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
        <textarea id="description" name="description" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 
                   focus:ring-primary-500 focus:border-primary-500 
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                   dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Mencakup aspek emosi, cara berpikir, dan perilaku seperti stress berlebih seorang individu">{{ old('description', $counselingType->description ?? '') }}</textarea>
    </div>

    <!-- Image Upload -->
    <div class="sm:col-span-2">
        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>

        <input type="file" name="image" id="image" accept="image/*"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer 
                   bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 
                   dark:placeholder-gray-400">

        @if (!empty($counselingType->image))
            <div class="mt-3">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Gambar saat ini:</p>
                <img src="{{ asset('storage/' . $counselingType->image) }}" alt="Gambar {{ $counselingType->name }}"
                    class="w-48 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
            </div>
        @endif
    </div>

</div>
