<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExamTypeController extends Controller
{
    public function examTypeIndex(): View
    {
        $allExams = ExamType::all();
        return view('admin.setup.all_exam_types', compact('allExams'));
    }

    public function examTypeStore(Request $request): RedirectResponse
    {
        return storeOrUpdateModel(ExamType::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return storeOrUpdateModel(ExamType::class, $request->all(), $id);
    }

    public function destroy(ExamType $examType): RedirectResponse
    {
        $examType->delete();
        return redirect()->back()->with('success', 'Delete success');
    }
}
