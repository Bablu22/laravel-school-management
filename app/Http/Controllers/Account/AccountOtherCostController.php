<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\OtherCostAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AccountOtherCostController extends Controller
{
    public function AccountOtherCostView(): View
    {
        $data['allData'] = OtherCostAccount::orderBy('id', 'desc')->get();
        return view('admin.account.others.other_cost_view', $data);
    }

    public function AccountOtherCostStore(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }
        $cost = new OtherCostAccount();
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;
        $cost->description = $request->description;
        $cost->save();

        return redirect()->back()->with('success', 'Cost added success');
    }

    public function AccountOtherCostUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return handleValidationErrors($validator);
        }

        $cost = OtherCostAccount::find($id);
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;
        $cost->description = $request->description;
        $cost->save();

        return redirect()->back()->with('success', 'Cost update success');
    }

    public function AccountOtherCostDelete($id): RedirectResponse
    {
        $cost = OtherCostAccount::find($id);
        $cost->delete();
        return redirect()->back()->with('success', 'Cost delete success');
    }
}

