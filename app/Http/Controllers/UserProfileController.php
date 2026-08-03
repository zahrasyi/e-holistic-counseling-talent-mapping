<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|numeric',
            'gender' => 'nullable|string|in:male,female',
            'address' => 'nullable|string|min:3',
            'password' => ['nullable', 'confirmed', Password::min(3)->numbers()],
        ]);


        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Profile update successfully');
    }

    public function updateCounselorDetails(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('konselor')) {
            abort(403);
        }

        $validated = $request->validate([
            'bio' => 'nullable|string|max:1000',
            'education' => 'nullable|array',
            'education.*.gelar' => 'required_with:education.*.universitas|string|max:255|nullable',
            'education.*.universitas' => 'required_with:education.*.gelar|string|max:255|nullable',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $counselorData = [
            'bio' => $validated['bio'],
            'education_history' => array_values(array_filter($validated['education'] ?? [], function ($edu) {
                return !empty($edu['gelar']) && !empty($edu['universitas']);
            })),
        ];

        if ($request->hasFile('profile_photo')) {
            if ($user->counselor && $user->counselor->profile_photo_path) {
                Storage::disk('public')->delete($user->counselor->profile_photo_path);
            }
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $counselorData['profile_photo_path'] = $path;
        }

        $user->counselor()->updateOrCreate(
            ['user_id' => $user->id],
            $counselorData
        );

        return redirect()->route('profile.edit')->with('succes_counselor', 'Counselor data updated');
    }
}
