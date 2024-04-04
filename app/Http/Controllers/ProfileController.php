<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, $id = ''): Response
    {
        if ($id === '') {
            $user = $request->user();

            if (!$user) {
                return redirect()->route('login');
            }

            return Inertia::render('Profile/Edit', [
                'mustVerifyEmail' => $user instanceof MustVerifyEmail,
                'status' => session('status'),
                'roles' => Role::all(),
            ]);
        }

        $user = User::findOrFail($id);
        $user->load(['roles','permissions']);

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => new UserResource($user),
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = User::find($request->id);
        if ($request->hasFile('avatar')) {

            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $avatarPath;
        }

        $user->fill($request->only(['name', 'email']));

        $user->syncRoles($request->input('roles.*.name'));
        $user->syncPermissions($request->input('permissions.*.name'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit', $user->id)->with('success', 'Profile updated successfully.');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = User::find($request->id);

        $isAuth = $user === $request->user();

        if ($isAuth) {

            $request->validate([
                'password' => ['required', 'current_password'],
            ]);

            Auth::logout();
            $user->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return Redirect::to('/')->with('success', 'User Deleted Successfully');
        }

        $user->delete();
        return Redirect::to('/users')->with('success', 'User Deleted Successfully');
    }
}
