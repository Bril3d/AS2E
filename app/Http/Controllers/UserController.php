<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\RoleResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')->orderBy('name')->paginate(setting('pagination_limit'));
        } else {
            $users = User::orderBy("name")->paginate(setting('pagination_limit'));
        }

        $users->load(['roles', 'permissions']);

        return Inertia::render("Users/Users", ["users" => UserResource::collection($users)]);
    }

    public function edit(string $id): Response
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return redirect()->route('users');
        }

        $user->load('roles');

        return Inertia::render('Users/Edit', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => new UserResource($user),
            'roles' => RoleResource::collection(Role::all()),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Create', ['roles' => Role::all(), 'permissions' => Permission::all()]);
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = null;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
        ]);

        $user->syncRoles($request->input('roles.*.name'));
        $user->syncPermissions($request->input('permissions.*.name'));

        return to_route('users.index')->with('User Created Succussfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findById($id);
        $role->delete();
        return back();
    }
}
