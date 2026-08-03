<?php

namespace App\Http\Controllers;
use App\Models\CounselingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CounselingTypeController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'CounselingType', 'url' => null],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Tipe Konseling', 'class' => 'w-100 text-center'],
            ['label' => 'Deskripsi', 'class' => 'text-center'],
            ['label' => 'Action', 'class' => 'w-32 text-center'],
        ];

        $counselingType = CounselingType::latest()->paginate(10);

        return view('counselingType.index', compact('counselingType', 'tableHeaders', 'breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'CounselingType', 'url' => route('counselingType.index')],
            ['name' => 'Create', 'url' => null],
        ];

        $counselingType = CounselingType::all();

        return view('counselingType.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('counseling_types', 'public');
        }

        CounselingType::create($validated);

        return redirect()->route('counselingType.index')->with('success', 'Counseling Type created succesfully');
    }

    public function edit(CounselingType $counselingType)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'CounselingType', 'url' => route('counselingType.index')],
            ['name' => 'Edit', 'url' => null],
        ];

        return view('counselingType.edit', compact('counselingType', 'breadcrumbs'));
    }

    public function update(Request $request, CounselingType $counselingType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ]);
        if ($request->hasFile('image')) {
            if ($counselingType->image && Storage::disk('public')->exists($counselingType->image)) {
                Storage::disk('public')->delete($counselingType->image);
            }
            $validated['image'] = $request->file('image')->store('counseling_types', 'public');
        }

        $counselingType->update($validated);

        return redirect()->route('counselingType.index')->with('success', 'Counseling Type updated successfully');
    }

    public function destroy($id)
    {
        $counselingType = CounselingType::findOrFail($id);

        // hapusd image
        if ($counselingType->image) {
            Storage::disk('public')->delete($counselingType->image);
        }

        $counselingType->delete();

        return redirect()->route('counselingType.index')->with('success', 'Counseling Type deleted successfully');
    }
}
