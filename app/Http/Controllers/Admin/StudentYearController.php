<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentYearController extends Controller
{
    public function yearsIndex(): View
    {
        $allYears = StudentYear::all();
        return view('admin.setup.all_year', compact('allYears'));
    }

    public function yearsStore(Request $request): RedirectResponse
    {
        return storeOrUpdateModel(StudentYear::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return storeOrUpdateModel(StudentYear::class, $request->all(), $id);
    }

    public function destroy(StudentYear $year): RedirectResponse
    {
        $year->delete();
        toastr()->success('Student year deleted success.');
        return redirect()->back();
    }
}
