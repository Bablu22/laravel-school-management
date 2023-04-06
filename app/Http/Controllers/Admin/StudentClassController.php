<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentClassController extends Controller
{
    public function classIndex(): View
    {
        $allClass = StudentClass::all();
        return view('admin.setup.all_class', compact('allClass'));
    }

    public function classStore(Request $request): RedirectResponse
    {
        return storeOrUpdateModel(StudentClass::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return storeOrUpdateModel(StudentClass::class, $request->all(), $id);
    }

    public function destroy(StudentClass $class): RedirectResponse
    {
        $class->delete();
        toastr()->success('User deleted success.');
        return redirect()->route('class.all');
    }
}
