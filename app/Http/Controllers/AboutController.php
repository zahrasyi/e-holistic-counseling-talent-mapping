<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $counselors = User::role('konselor')
            ->with('counselor', 'specializations')
            ->orderBy('name', 'asc')->get();

        return view('about.index', [
            'counselors' => $counselors
        ]);
    }

    public function show(User $user)
    {
        if (!$user->hasRole('konselor')) {
            abort(404);
        }
        $user->load('counselor', 'specializations');

        return view('about.show', compact('user'));
    }
}
