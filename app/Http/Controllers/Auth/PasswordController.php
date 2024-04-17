<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {

        $authId = Auth::id();

        $validationRules = [
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];

        if ($authId === $request->id) {
            $validationRules['current_password'] = ['required', 'current_password'];
            $validatedData = $request->validate($validationRules);
            $request->user()->update([
                'password' => Hash::make($validatedData['password']),
            ]);
        } else {
            $user = User::findOrFail($request->id);
            $validatedData = $request->validate($validationRules);
            $user->update([
                'password' => Hash::make($validatedData['password']),
            ]);
        }

        return back()->with('success', 'Password Updated Successfully');
    }
}
