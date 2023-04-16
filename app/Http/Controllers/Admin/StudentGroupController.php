<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentGroupController extends Controller
{
    public function groupIndex(): View
    {
        $allGroups = StudentGroup::all();
        return view('admin.setup.all_groups', compact('allGroups'));
    }

    public function groupStore(Request $request): RedirectResponse
    {
        return storeOrUpdateModel(StudentGroup::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return storeOrUpdateModel(StudentGroup::class, $request->all(), $id);
    }

    public function destroy(StudentGroup $group): RedirectResponse
    {
        $group->delete();
        return redirect()->back()->with('success', 'Delete success');
    }
}
