<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Rules\DomainValidation;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name,'.Auth::id()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::id(), new DomainValidation()],
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePropic(Request $request)
    {
        $image_id = ImageController::persist($request->image);
        $user = Auth::user();
        $user->propic = $image_id;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'image-updated');
    }

    /**
     * Updates the user's mail notification settings.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function updateMailSettings(Request $request)
    {
        $notification_type = $request->type;
        $user = Auth::user();
        $mail_settings = $user->mailSettings()->first();
        $mail_settings->$notification_type = !$mail_settings->$notification_type; 
        $mail_settings->save();
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
