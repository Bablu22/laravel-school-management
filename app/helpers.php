<?php


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

function storeOrUpdateModel($modelClass, $requestData, $id = null): RedirectResponse
{
    $validator = Validator::make($requestData, [
        'name' => 'required|unique:' . (new $modelClass)->getTable() . ',name,' . ($id ? $id : 'NULL')
    ]);
    if ($validator->fails()) {
        foreach ($validator->errors()->all() as $error) {
            toastr()->error($error);
        }
        return redirect()->back()->withInput();
    }
    $model = $id ? $modelClass::find($id) : new $modelClass();
    $model->name = $requestData['name'];
    $model->save();
    toastr()->success(($id ? 'Update' : 'Add') . ' success');
    return redirect()->back();
}

function handleValidationErrors($validateData): RedirectResponse
{
    foreach ($validateData->errors()->all() as $error) {
        toastr()->error($error);
    }
    return redirect()->back()->withInput();
}
