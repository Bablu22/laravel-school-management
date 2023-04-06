<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('admin.user.all_users', compact('users'));
    }

    public function create(): View
    {
        return view('admin.user.create_user');
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return redirect()->back()->withInput();
        }

        $user = new  User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();
        toastr()->success('User created success.');
        return redirect()->route('user.all');
    }

    public function update(User $user): View
    {
        return view('admin.user.update_user', compact('user'));
    }

    public function storeUpdate(Request $request, User $user): RedirectResponse
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
        toastr()->success('User updated success.');
        return redirect()->route('user.all');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (Storage::disk('public')->exists('/uploads/avatar/' . $user->profile_photo_path)) {
            Storage::disk('public')->delete('/uploads/avatar/' . $user->profile_photo_path);
        }
        $user->delete();
        toastr()->success('User deleted success.');
        return redirect()->route('user.all');
    }

    public function deactivateUser(User $user): RedirectResponse
    {
        $user->status = 0;
        $user->save();
        toastr()->success('User has been deactivated.');
        return back();
    }

    public function activateUser(User $user): RedirectResponse
    {
        $user->status = 1;
        $user->save();
        toastr()->success('User has been activated.');
        return back();
    }

}
