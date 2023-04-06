<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'memo_name' => 'required|max:500|string',
            //
        ];
    }
    public function attributes()
    {
        return[
            'memo_name'=>'メモ名',
            
        ];
    }

    public function messages()
    {
        return[
            'due_date.after_or_equal' => ':attributeには今日以降の日付を指定してください。',
        ];
    }
}
