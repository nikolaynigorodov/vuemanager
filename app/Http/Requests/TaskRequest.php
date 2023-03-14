<?php

namespace App\Http\Requests;

use App\Services\UserEncodeDecode;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'end_date' => ['required', 'date_format:Y-m-d'],
            'status' => ['required', 'integer' ,'between: 1,3'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "user_id" => auth("web")->id(),
        ]);
    }
}
