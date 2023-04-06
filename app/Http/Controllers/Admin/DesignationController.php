<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DesignationController extends Controller
{
    public function designationIndex(): View
    {
        $designations = Designation::all();
        return view('admin.setup.all_designation', compact('designations'));
    }

    public function designationStore(Request $request): RedirectResponse
    {
        return storeOrUpdateModel(Designation::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return storeOrUpdateModel(Designation::class, $request->all(), $id);
    }

    public function destroy(Designation $designation): RedirectResponse
    {
        $designation->delete();
        toastr()->success('Designation deleted success.');
        return redirect()->back();
    }
}
