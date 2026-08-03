@php
    use Illuminate\Support\Str;
    use Illuminate\Support\HtmlString;
    $currentPage = $konselors->currentPage();
    $perPage = $konselors->perPage();
    $specialization = $specializations;
@endphp

<x-layouts.app>
    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Counselor Management" description="Manage counselor master data here .">
    </x-partials.header>

    <x-tables.table-main :headers="$tableHeaders" :rows="$konselors->map(function ($user, $index) use ($currentPage, $perPage, $specialization) {
        $specializationNames = $user->specializations->pluck('name')->join(', ');
        $bio = optional($user->counselor)->bio;
        $education = optional($user->counselor)->education_history;
        $last_education = '-';
        if (!empty($education) && is_array($education)) {
            $last_edu_item = end($education);
            $last_education = ($last_edu_item['gelar'] ?? '') . ' - ' . ($last_edu_item['universitas'] ?? '');
        }
    
        return [
            $index + 1 + ($currentPage - 1) * $perPage,
            $user->name,
            $specializationNames ?: 'Belum di-assign',
            $bio ? Str::limit($bio, 70, '...') : '-',
            $last_education,
            new HtmlString(
                view('assignment.partials._actions', [
                    'user' => $user,
                    'specializations' => $specialization,
                ])->render(),
            ),
        ];
    })" />

</x-layouts.app>
