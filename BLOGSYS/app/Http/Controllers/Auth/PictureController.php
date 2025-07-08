<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class PictureController extends Controller
{
    /**
     * Update the user's photo.
     */
    public function update(Request $request): RedirectResponse
{
    $request->validateWithBag('updateProfilePicture', [
        'new_profile' => ['required', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
    ]);

    $user = Auth::user();
    $file = $request->file('new_profile');

    // 1. Define the new filename and the relative path for the database
    $newFileName = str_replace(" ", "-", strtolower($user->email)) . '.' . $file->getClientOriginalExtension();
    $newDbPath = 'assets/picture/' . $newFileName;

    // 2. Define the full server path for the destination
    $destinationPath = public_path('assets/picture');

    // 3. Get the path of the old profile picture
    $oldPicturePath = public_path($user->profile_picture);

    // 4. Move the new file to the public assets folder
    $file->move($destinationPath, $newFileName);

    // 5. If a different old picture exists, delete it
    if ($user->profile_picture && File::exists($oldPicturePath)) {
        // Prevent deleting the default image or the image you just uploaded if names are the same
        if (basename($oldPicturePath) !== $newFileName) {
             File::delete($oldPicturePath);
        }
    }

    // 6. Update the user's record with the full relative path
    $user->update([
        'profile_picture' => $newDbPath,
    ]);

    return back()->with('status', 'profile-picture-updated');
}
}
