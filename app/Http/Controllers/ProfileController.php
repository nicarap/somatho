<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    public function showUser(Request $request, User $User)
    {
        return Inertia::render('Profile/User/Show', [
            'User' => new UserResource($User->load(['UserInfo', 'roles'])),
        ]);
    }

    public function showTherapist(Request $request, User $therapist)
    {
        return Inertia::render('Profile/Therapist/Show', [
            'therapist' => new UserResource($therapist),
        ]);
    }

    public function show(Request $request, User $user)
    {
        return Inertia::render('Profile/Therapist/Show', [
            'user' => new UserResource($user),
        ]);
    }

    public function agenda(Request $request, User $user){
        return Inertia::render('Profile/Therapist/Agenda', [
            'therapist' => new UserResource($user),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
