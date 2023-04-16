<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function subjectIndex(): View
    {
        $subjects = Subject::all();
        return view('admin.setup.all_subjects', compact('subjects'));
    }

    public function subjectStore(Request $request): RedirectResponse
    {
        return storeOrUpdateModel(Subject::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return storeOrUpdateModel(Subject::class, $request->all(), $id);
    }

    public function destroy(Subject $subject): RedirectResponse
    {
        $subject->delete();
        return redirect()->back()->with('success', 'Delete success');
    }
}
