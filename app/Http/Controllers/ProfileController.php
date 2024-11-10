<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }


    public function update(Request $request)
{
    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
    ]);

    // Get the authenticated user
    $user = Auth::user();

    // Handle the profile photo upload if there's one
    if ($request->hasFile('profile_photo')) {
        // Store the new profile photo in the 'profile_photos' directory within the public disk
        $path = $request->file('profile_photo')->store('images/profile_photos', 'public');
        // dd($path);  // Check if the path is generated correctly

        // Update the profile photo path in the database
        // $user->update(['profile_photo_path'=>$path]);
        // $user = User::find(1); // Example: Find the user with ID 1
        $user->profile_photo_path = $path;
        $user->save();

    }
    // dd($user->id);

    // Update other user details (name, email)
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return back()->with('status', 'profile-updated');
}



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
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
