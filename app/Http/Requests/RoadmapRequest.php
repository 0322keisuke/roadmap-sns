<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoadmapRequest extends FormRequest
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
            'title' => 'required|max:50',
            'tutorial_task_names' => 'required|json|not_in:[]',
            'body' => 'required|max:500',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
            'estimated_time' => 'required|max:300',
            'level' => 'required|max:3',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'ロードマップ名',
            'tutorial_task_names' => '教材名・タスク名',
            'body' => '説明',
            'tags' => 'タグ',
            'estimated_time' => '学習時間目安',
            'level' => '学習レベル',
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tutorial_task_names.not_in' => '教材名は必ず入力してください。',
        ];
    }

    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }
}
