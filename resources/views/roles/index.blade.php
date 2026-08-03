<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    {{-- tabs --}}
    <x-partials.tabs :tabs="[['label' => 'Role', 'route' => route('roles.index')], ['label' => 'Permission', 'route' => null]]" active="Role" />

    <x-partials.header title="Manajemen Role" description="Kelola Master Role Disini.">
        <x-slot name="actions">
            <a href="{{ route('roles.create') }}">
                <button type="button" class="text-white bg-green-600 hover:bg-green-700 px-5 py-2.5 rounded-lg">
                    Buat role
                </button>
            </a>
        </x-slot>
    </x-partials.header>


    <x-tables.table-main :headers="$tableHeaders" :rows="$roles->map(function ($role, $index) use ($roles) {
        return [
            'no' => $index + 1 + ($roles->currentPage() - 1) * $roles->perPage(),
            'name' => $role->name,
            'guard_name' => $role->guard_name,
            'actions' => view('roles.partials._actions', compact('role'))->render(),
        ];
    })" />
</x-layouts.app>
