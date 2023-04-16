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
            return handleValidationErrors($validator);
        }
        $code = $request->password;
        $user = new  User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->code = $code;
        $user->password = bcrypt($code);
        $user->role = $request->role;
        $user->save();
        return redirect()->back()->with('success', 'User create success');
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
        return redirect()->back()->with('success', 'Update success');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (Storage::disk('public')->exists('/uploads/avatar/' . $user->profile_photo_path)) {
            Storage::disk('public')->delete('/uploads/avatar/' . $user->profile_photo_path);
        }
        $user->delete();
        return redirect()->back()->with('success', 'Delete success');
    }

    public function deactivateUser(User $user): RedirectResponse
    {
        $user->status = 0;
        $user->save();
        return redirect()->back()->with('success', 'User has been deactivated.');

    }

    public function activateUser(User $user): RedirectResponse
    {
        $user->status = 1;
        $user->save();
        return redirect()->back()->with('success', 'User has been activated.');
    }

}
