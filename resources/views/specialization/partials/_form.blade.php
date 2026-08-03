<div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pt-5">

    <!-- Name -->
    <div class="sm:col-span-2">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name', $specialization->name ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                       focus:border-primary-600 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Psikologis" required>
    </div>


    <div class="sm:col-span-2">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
        <textarea id="description" name="description" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 
                       focus:ring-primary-500 focus:border-primary-500 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Spesialisasi di bidang psikologis..">{{ old('description', $specialization->description ?? '') }}</textarea>
    </div>

</div>
