<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'name' => 'required|max:50|unique:users,name,' . $this->id,
            'email' => 'required|email|unique:users,email,' . $this->id,
            'phone' => 'required|max:20|unique:users,phone,' . $this->id,
            'province' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
            'zip_code' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:300',
            'role_id' => 'required|integer'
        ];
    }
}
