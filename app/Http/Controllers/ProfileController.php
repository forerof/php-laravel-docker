<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Update the authenticated user's profile information.
     */
    public function update(Request $request, UpdateUserProfileInformation $updater)
    {
        $updater->update($request->user(), $request->all());

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }
}
