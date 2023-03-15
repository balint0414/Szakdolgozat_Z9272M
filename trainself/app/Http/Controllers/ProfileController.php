<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function show(User $user)
    {
        return view('profile.show',[
            'user' => $user,
            'profile' => $user->profile,
        ])->with(compact('user'));
    }

    public function showEdzo()
    {
        $users = User::where('role', 'Edző')->get();

        return view('profile.profilesEdzok', ['users' => $users]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $image = $this->uploadImage($request);

        if (!$user) {
            return response()->json(['message' => 'A felhasználó nem található!'], 404);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->age = $request->input('age');
        $user->description = $request->input('description');

        if($image){
            $user->avatar = $image->basename;
            $user->save();
        }

        
        //return dd($request);
        return redirect()->route('profile.details', $user)->with('success', __('Sikeres profil frissítés!'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
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

    private function uploadImage(Request $request)
    {
        $file = $request->file('avatar');

        if(!$file)
        {
            return;
        }

        $fileName = uniqid();

        $avatar = Image::make($file)->save(public_path("upload/users/{$fileName}.{$file->extension()}"));

        return $avatar;
    }
}
