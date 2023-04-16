<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentShiftController extends Controller
{
    public function shiftIndex(): View
    {
        $allShifts = StudentShift::all();
        return view('admin.setup.all_shift', compact('allShifts'));
    }

    public function shiftStore(Request $request): RedirectResponse
    {
        return storeOrUpdateModel(StudentShift::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return storeOrUpdateModel(StudentShift::class, $request->all(), $id);
    }

    public function destroy(StudentShift $shift): RedirectResponse
    {
        $shift->delete();
        return redirect()->back()->with('success', 'Delete success');
    }
}
