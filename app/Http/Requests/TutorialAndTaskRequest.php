<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorialAndTaskRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            '*.tasks' => 'array',
            '*.tasks.*' => 'string|max:30',
            '*.title' => 'required|string|max:30'
        ];
    }

    public function attributes()
    {
        return [
            '*.tasks' => 'タスク一覧',
            '*.tasks.*' => 'タスク名',
            '*.title' => '教材名'
        ];
    }
}
