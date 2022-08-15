<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactSendRequest extends FormRequest
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
            'department' => 'required|string|email|max:55',
            'name'       => 'required|string|between:5,20',
            'email'      => 'required|string|email|between:5,20',
            'subject'    => 'required|string|between:5,255',
            'content'    => 'required|string|between:10,1500'
        ];
    }
}
