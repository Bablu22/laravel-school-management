<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeeCategoryController extends Controller
{
    public function feeIndex(): View
    {
        $feeCategories = FeeCategory::all();
        return view('admin.setup.all_fee_category', compact('feeCategories'));
    }

    public function feeStore(Request $request): RedirectResponse
    {
        return storeOrUpdateModel(FeeCategory::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return storeOrUpdateModel(FeeCategory::class, $request->all(), $id);
    }

    public function destroy(FeeCategory $year): RedirectResponse
    {
        $year->delete();
        return redirect()->back()->with('success', 'Delete success');
    }
}
