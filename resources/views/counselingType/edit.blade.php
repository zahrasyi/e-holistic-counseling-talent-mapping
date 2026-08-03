<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Manajemen Tipe Konseling" description="Edit Tipe Konseling Disini." />

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

    <div
        class="px-8 mx-auto w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">

        <h2 class="py-6 text-xl font-bold text-gray-900 dark:text-white">Edit Tipe Konseling Baru</h2>
        <hr class="border border-gray-300 dark:border-gray-600">

        <form action="{{ route('counselingType.update', $counselingType->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{--  partial _form --}}
            @include('counselingType.partials._form')

            <div class="flex items-center space-x-4 mt-4 sm:mt-6">
                <button type="submit"
                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Update</button>

                <a href="{{ route('counselingType.index') }}">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Back</button>
                </a>
            </div>
        </form>

    </div>
</x-layouts.app>
