<?php


namespace App\Validate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiSubtaskValidate implements ApiValidateInterface
{

    public function rules(Request $request)
    {
        return Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required'],
            'end_date' => ['required', 'date_format:Y-m-d'],
            'status' => ['required', 'integer' ,'between: 1,3'],
            'user_id' => ['required', 'exists:users,id'],
            'task_id' => ['required', 'exists:tasks,id'],
        ],
        [
           'status.between' => "The status must be number: 1 - Waiting, 2 - In progress, 3 - Completed",
           'status.required' => "The status field is required AND The status must be number: 1 - Waiting, 2 - In progress, 3 - Completed",
           'status.integer' => "The status must be number: 1 - Waiting, 2 - In progress, 3 - Completed",
           'end_date.required' => "The end date field is required AND The end date does not match the format Y-m-d, example 2000-01-28",
           'end_date.date_format' => "The end date does not match the format Y-m-d, example 2000-01-28"
        ]);
    }
}
