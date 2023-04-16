<?php


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

function storeOrUpdateModel($modelClass, $requestData, $id = null): RedirectResponse
{
    $validator = Validator::make($requestData, [
        'name' => 'required|unique:' . (new $modelClass)->getTable() . ',name,' . ($id ? $id : 'NULL')
    ]);

    if ($validator->fails()) {
        return handleValidationErrors($validator);
    }

    $model = $id ? $modelClass::find($id) : new $modelClass();
    $model->name = $requestData['name'];
    $model->save();
    return redirect()->back()->with('success', ($id ? 'Update' : 'Add') . ' success');
}

function handleValidationErrors($validateData): ?RedirectResponse
{
    foreach ($validateData->errors()->all() as $error) {
        return redirect()->back()->with('error', $error);
    }
    return null;
}
