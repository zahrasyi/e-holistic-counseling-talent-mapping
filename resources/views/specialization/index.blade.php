@php
    $currentPage = $specialization->currentPage();
    $perPage = $specialization->perPage();
@endphp

<x-layouts.app>
    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.tabs :tabs="[
        ['label' => 'Counseling Type', 'route' => route('counselingType.index')],
        ['label' => 'Specialization', 'route' => route('specialization.index')],
    ]" active="Specialization" />

    <x-partials.header title="Manajemen Spesialasi" description="Kelola Master Spesialisasi Disini.">
        <x-slot name="actions">
            <a href="{{ route('specialization.create') }}">
                <button type="button" class="text-white bg-green-600 hover:bg-green-700 px-5 py-2.5 rounded-lg">
                    Create Specialization
                </button>
            </a>
        </x-slot>
    </x-partials.header>

    <x-tables.table-main :headers="$tableHeaders" :rows="$specialization->map(function ($specialization, $index) use ($currentPage, $perPage) {
        return [
            'no' => $index + 1 + ($currentPage - 1) * $perPage,
            'name' => $specialization->name,
            'description' => $specialization->description,
            'actions' => view('specialization.partials._actions', compact('specialization'))->render(),
        ];
    })" />
</x-layouts.app>
