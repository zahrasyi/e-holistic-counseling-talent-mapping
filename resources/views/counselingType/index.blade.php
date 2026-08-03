@php
    $currentPage = $counselingType->currentPage();
    $perPage = $counselingType->perPage();
@endphp

<x-layouts.app>
    <x-partials.breadcrumbs :items="$breadcrumbs" />
    <x-partials.tabs :tabs="[
        ['label' => 'Counseling Type', 'route' => route('counselingType.index')],
        ['label' => 'Specialization', 'route' => route('specialization.index')],
    ]" active="Counseling Type" />

    <x-partials.header title="Counseling Type Manager" description="Manage Counseling Type Here.">
        <x-slot name="actions">
            <a href="{{ route('counselingType.create') }}">
                <button type="button" class="text-white bg-green-600 hover:bg-green-700 px-5 py-2.5 rounded-lg">
                    Create Counseling Type Here
                </button>
            </a>
        </x-slot>
    </x-partials.header>

    <x-tables.table-main :headers="$tableHeaders" :rows="$counselingType->map(function ($counselingType, $index) use ($currentPage, $perPage) {
        return [
            'no' => $index + 1 + ($currentPage - 1) * $perPage,
            'name' => $counselingType->name,
            'description' => $counselingType->description,
            'actions' => view('counselingType.partials._actions', compact('counselingType'))->render(),
        ];
    })" />
</x-layouts.app>
