<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AssignSubjectController extends Controller
{
    public function subjectAssignIndex(): View
    {
        $data['allData'] = AssignSubject::all();
        $data['subjects'] = Subject::all();
        $data['student_classes'] = StudentClass::all();
        return view('admin.setup.all_assign_subject', $data);
    }

    public function details($class_id): View
    {

        $data['detailsData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id')->get();
        return view('admin.setup.subject_details', $data);
    }

    public function subjectAssignStore(Request $request): RedirectResponse
    {
        return $this->storeOrUpdateModel(AssignSubject::class, $request->all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        return $this->storeOrUpdateModel(AssignSubject::class, $request->all(), $id);
    }

    public function destroy($id): RedirectResponse
    {
        $fee_category_amount = AssignSubject::find($id);
        $fee_category_amount->delete();
        toastr()->success('Deleted success.');
        return redirect()->back();
    }

    function storeOrUpdateModel($modelClass, $requestData, $id = null): RedirectResponse
    {
        $validateData = Validator::make($requestData, [
            'full_mark' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'pass_mark' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'subjective_mark' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        if ($validateData->fails()) {
            return handleValidationErrors($validateData);
        }

        $model = $id ? $modelClass::find($id) : new $modelClass();
        $model->subject_id = $requestData['subject_id'];
        $model->class_id = $requestData['class_id'];
        $model->full_mark = $requestData['full_mark'];
        $model->pass_mark = $requestData['pass_mark'];
        $model->subjective_mark = $requestData['subjective_mark'];
        $model->save();
        toastr()->success(($id ? 'Update' : 'Add') . ' success');
        return redirect()->back();
    }
}

