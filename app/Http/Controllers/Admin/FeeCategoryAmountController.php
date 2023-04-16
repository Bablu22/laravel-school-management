<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FeeCategoryAmountController extends Controller
{
    public function feeAmountIndex(): View
    {
        $data['feeAmounts'] = FeeCategoryAmount::all();
        $data['fee_categories'] = FeeCategory::all();
        $data['student_classes'] = StudentClass::all();
        return view('admin.setup.all_fee_amount', $data);
    }

    public function feeAmountStore(Request $request): RedirectResponse
    {
        return $this->storeOrUpdateModel(FeeCategoryAmount::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return $this->storeOrUpdateModel(FeeCategoryAmount::class, $request->all(), $id);
    }

    public function destroy($id): RedirectResponse
    {
        $fee_category_amount = FeeCategoryAmount::find($id);
        $fee_category_amount->delete();
        return redirect()->back()->with('success', 'Delete success');
    }

    function storeOrUpdateModel($modelClass, $requestData, $id = null): RedirectResponse
    {
        $validator = Validator::make($requestData, [
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'class_id' => [
                'required',
                Rule::unique('fee_category_amounts')->where(function ($query) use ($requestData) {
                    return $query->where('fee_category_id', $requestData['fee_category_id']);
                })->ignore($id),
            ],
        ]);

        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }

        $model = $id ? $modelClass::find($id) : new $modelClass();
        $model->fee_category_id = $requestData['fee_category_id'];
        $model->class_id = $requestData['class_id'];
        $model->amount = $requestData['amount'];
        $model->save();

        return redirect()->back()->with('success', ($id ? 'Update' : 'Add') . ' success');
    }

}

