<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Specializations;
use Spatie\Permission\Models\Role;

class SpecializationsController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Specializations', 'url' => null],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Spesialisasi', 'class' => 'w-64 text-center'],
            ['label' => 'Deskripsi', 'class' => 'text-center'],
            ['label' => 'Action', 'class' => 'w-32 text-center'],
        ];

        $specialization = Specializations::latest()->paginate(10);

        return view('specialization.index', compact('specialization', 'tableHeaders', 'breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Specialization', 'url' => route('specialization.index')],
            ['name' => 'Create', 'url' => null],
        ];

        $specializations = Specializations::all();

        return view('specialization.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        Specializations::create($validated);

        return redirect()->route('specialization.index')->with('success', 'Specialization created succesfully');
    }

    public function edit(Specializations $specialization)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Specialization', 'url' => route('specialization.index')],
            ['name' => 'Edit', 'url' => null],
        ];

        $roles = Role::all();

        return view('specialization.edit', compact('specialization', 'breadcrumbs'));
    }

    public function update(Request $request, Specializations $specializations)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $specializations->update($validated);

        return redirect()->route('specialization.index')->with('success', 'Specializations updated successfully');
    }

    public function destroy($id)
    {
        $specialization = Specializations::findOrFail($id);
        $specialization->delete();

        return redirect()->route('specialization.index')->with('success', 'Specialization deleted successfully');
    }
}
