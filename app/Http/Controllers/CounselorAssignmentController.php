<?php

namespace App\Http\Controllers;

use App\Models\Specializations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CounselorAssignmentController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Specializations', 'url' => null],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Nama', 'class' => 'text-center'],
            ['label' => 'Specializations', 'class' => 'text-center'],
            ['label' => 'Biography', 'class' => 'text-center w-64'],
            ['label' => 'Education History', 'class' => 'text-center w-56'],
            ['label' => 'Action', 'class' => 'text-center'],
        ];

        $konselors = User::role('konselor')
            ->with('specializations', 'counselor')
            ->latest()
            ->paginate(10);

        $specializations = Specializations::all();

        $tableRows = $konselors->map(function ($user, $index) use ($konselors) {
            $specializationNames = $user->specializations->pluck('name')->join(', ');

            $bio = optional($user->counselor)->bio;
            $education = optional($user->counselor)->educational_history;

            $last_education = '-';
            if (!empty($education) && is_array($education)) {
                $last_edu_item = end($education);
                $last_education = ($last_edu_item['gelar'] ?? '') . ' - ' . ($last_edu_item['universitas'] ?? '');
            }

            return [
                'no' => $index + 1 + ($konselors->currentPage() - 1) * $konselors->perPage(),
                'nama' => $user->name,
                'spesialisasi' => $specializationNames ?: 'Belum di-assign',
                'bio_singkat' => Str::limit($bio, 70, '...'),
                'pendidikan_terakhir' => $last_education,
                'actions' => view('assignment.partials._actions', ['user' => $user])->render(),
            ];
        });

        return view('assignment.index', compact(
            'konselors',
            'specializations',
            'breadcrumbs',
            'tableHeaders',
            'tableRows',
        ));

    }

    public function edit(User $user)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Konselor', 'url' => route('assignment.index')],
            ['name' => 'Edit', 'url' => null],
        ];

        $user->load('counselor', 'specializations');
        $specializations = Specializations::all();

        return view('assignment.edit', compact('user', 'breadcrumbs', 'specializations'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'specializations' => 'nullable|array',
            'specializations.*' => 'exists:specializations,id',
            'bio' => 'nullable|string|max:1000',
            'education' => 'nullable|array',
            'education.*.gelar' => 'required_with:education.*.universitas|string|max:255',
            'education.*.universitas' => 'required_with:education.*.gelar|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if (!$user->hasRole('konselor')) {
            return back()->withErrors(['user_id' => 'Selected user is not a counselor.']);
        }

        try {
            $educationData = $validated['education'] ?? [];

            $filteredEducation = array_filter($educationData, function ($edu) {
                return !empty($edu['gelar']) && !empty($edu['universitas']);
            });
            DB::transaction(function () use ($validated, $user, $filteredEducation) {
                $user->specializations()->sync($validated['specializations'] ?? []);

                $user->counselor()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'bio' => $validated['bio'],
                        'education_history' => array_values($filteredEducation),
                    ]
                );
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to save data');
        }

        if ($request->hasFile('profile_photo')) {
            if ($user->counselor() && $user->counselor->profile_photo_path) {
                Storage::disk('public')->delete($user->counselor->profile_photo_path);
            }

            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $counselorData['profile_photo_path'] = $path;
        }

        $user->counselor()->updateOrCreate(['user_id' => $user->id], $counselorData);
        $user->specializations()->sync($request->specializations ?? []);

        return redirect()->route('assignment.index')->with('success', "Counselor's speciality updated");
    }

}
