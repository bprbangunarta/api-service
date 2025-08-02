<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('id') ? Crypt::decryptString($this->route('id')) : null;

        return [
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'phone'    => ['nullable', 'string', 'max:12', Rule::unique('users')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:6'],
            'role'     => ['required'],
            'office'   => ['required'],
        ];
    }
}
