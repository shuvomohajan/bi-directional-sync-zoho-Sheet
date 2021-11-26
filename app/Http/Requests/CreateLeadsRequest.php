<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeadsRequest extends FormRequest
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
            'Company'    => ['nullable', 'string', 'max:255'],
            'Last_Name'  => ['required', 'string', 'max:255'],
            'First_Name' => ['nullable', 'string', 'max:255'],
            'Email'      => ['nullable', 'email', 'max:255'],
            'State'      => ['nullable', 'string', 'max:255'],
        ];
    }
}
