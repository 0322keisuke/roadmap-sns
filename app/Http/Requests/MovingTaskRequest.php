<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovingTaskRequest extends FormRequest
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
            'tasks' => 'required|array',
            'oldIndex' => 'required|integer',
            'newIndex' => 'required|integer',
            'id' => 'required|integer',
            'displayTutorialId' => 'required|integer',
            'status' => 'integer',
            'addStatus' => 'integer',
            'removeStatus' => 'integer',
        ];
    }

    public function attributes()
    {
        return [
            'tasks' => 'タスク一覧',
            'oldIndex' => '旧order',
            'newIndex' => '新order',
            'id' => 'タスクID',
            'displayTutorialId' => '表示中の教材ID',
            'status' => '進捗状態',
            'addStatus' => '追加先の状態',
            'removeStatus' => '削除元の状態',
        ];
    }
}
