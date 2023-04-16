<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function indexProfile(): View
    {
        $user = Auth::user();
        return view('admin.profile.show_profile', compact('user'));
    }

    public function editProfile(): View
    {
        $user = Auth::user();
        return view('admin.profile.edit_profile', compact('user'));
    }

    public function storeProfile(Request $request, User $user): RedirectResponse
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->address = $request->address;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads/avatar', $imageName);

            // unlink old image if exists
            if (Storage::disk('public')->exists('/uploads/avatar/' . $user->profile_photo_path)) {
                Storage::disk('public')->delete('/uploads/avatar/' . $user->profile_photo_path);
            }

            // Save the file name to the database
            $user->profile_photo_path = $imageName;
            $user->save();
        }
        $user->save();
        return redirect()->back()->with('success', 'Update success');
    }

    public function passwordChange(): View
    {
        return view('admin.profile.password_change');
    }

    public function passwordChangeStore(Request $request): RedirectResponse
    {
        $validateDAta = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect()->back()->with('success', 'Update success');
        } else {
            throw ValidationException::withMessages([
                'current_password' => 'The provided password does not match your current password.',
            ]);
        }

    }
}
