<?php

namespace App\Http\Requests\ChangeUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreChangeUserRequest extends FormRequest
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
            'change_id' => 'required|integer',
            'user_id' => 'required|integer'
        ];
    }
}
