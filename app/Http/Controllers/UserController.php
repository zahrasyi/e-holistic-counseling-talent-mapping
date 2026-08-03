<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request, UserFilter $userFilter)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('dashboard.adminDashboard')],
            ['name' => 'Users', 'url' => null],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Name', 'class' => 'w-full'],
            ['label' => 'Username', 'class' => 'w-48'],
            ['label' => 'Nip', 'class' => 'w-48'],
            ['label' => 'Email', 'class' => 'w-full'],
            // ['label' => 'Position', 'class' => 'w-48'],           
            // ['label' => 'Unit', 'class' => 'w-48'],               
            ['label' => 'Role', 'class' => 'w-32'],
            ['label' => 'Action', 'class' => 'w-32 text-center'],
        ];

        $users = User::filter($userFilter)->latest()->paginate(10)->withQueryString();

        return view('users.index', compact('users', 'tableHeaders', 'breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('dashboard.adminDashboard')],
            ['name' => 'Users', 'url' => route('users.index')],
            ['name' => 'Create', 'url' => null],
        ];

        $users = User::all();
        $roles = Role::all();

        return view('users.create', compact('breadcrumbs', 'users', 'roles'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'password' => ['required', Password::min(3)->numbers()],
            'address' => 'string|min:3',
            'gender' => 'string|in:male,female',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User created succesfully');
    }

    public function edit(User $user)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('dashboard.adminDashboard')],
            ['name' => 'Users', 'url' => route('users.index')],
            ['name' => 'Edit', 'url' => null],
        ];

        $roles = Role::all();

        return view('users.edit', compact('user', 'breadcrumbs', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|numeric',
            'password' => ['nullable', Password::min(3)->numbers()], // boleh kosong, tapi kalau diisi harus valid
            'gender' => 'nullable|string|in:male,female',
            'address' => 'nullable|string|min:3',
            'role' => 'required|exists:roles,name',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        unset($validated['role']); //hapus role di validasi sebelumnya

        $user->update($validated);
        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function show(User $user)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('dashboard.adminDashboard')],
            ['name' => 'Users', 'url' => route('users.index')],
            ['name' => 'Show', 'url' => null],
        ];

        $fields = [
            ['label' => 'ID', 'value' => $user->id],
            ['label' => 'Name', 'value' => $user->name],
            ['label' => 'Email', 'value' => $user->email],
            ['label' => 'Role', 'value' => $user->getRoleNames()->first()],
            ['label' => 'Phone', 'value' => $user->phone],
            ['label' => 'Gender', 'value' => $user->gender],
            ['label' => 'Address', 'value' => $user->address],
            ['label' => 'Created At', 'value' => $user->created_at],
            ['label' => 'Updated At', 'value' => $user->updated_at],
        ];

        return view('users.show', compact('breadcrumbs', 'user', 'fields'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
