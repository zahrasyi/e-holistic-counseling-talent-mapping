<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Manajemen Users" description="Kelola Master Users Disini.">
        <x-slot name="actions">
            <a href="{{ route('users.create') }}">
                <button type="button" class="text-white bg-green-600 hover:bg-green-700 px-5 py-2.5 rounded-lg">
                    Buat user
                </button>
            </a>
        </x-slot>
    </x-partials.header>

    <x-tables.table-filter :fields="['name', 'username', 'email', 'phone', 'gender', 'address']" :action="route('users.index')" />


    <x-tables.table-main :headers="$tableHeaders" :rows="$users->map(function ($user, $index) use ($users) {
        return [
            'no' => $index + 1 + ($users->currentPage() - 1) * $users->perPage(),
            'name' => $user->name,
            'username' => $user->username,
            'nip' => $user->nip,
            'email' => $user->email,
            // 'position' => $user->position->position_name,
            // 'unit' => $user->unit->unit_name,
            'role' => $user->getRoleNames()->first(),
            'actions' => view('users.partials._actions', compact('user'))->render(),
        ];
    })" />

    <div class="mt-5">
        {{ $users->links() }}
    </div>
</x-layouts.app>
