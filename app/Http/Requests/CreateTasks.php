<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTasks extends FormRequest
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
            'title' => 'required|max:255',
            'content' => 'required|max:255',
            'due_day' => 'required|date|after_or_equal:today',
        ];
    }
    
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'content' => '中身',
            'due_day' => '期限日',
        ];
    }
    public function messages()
    {
        return [
            'due_day.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
