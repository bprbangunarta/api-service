<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class CollectorUpdateRequest extends FormRequest
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
            'person'    => ['nullable', 'min:3', 'max:3', Rule::unique('collectors', 'person')->ignore($userId, 'user_id')],
            'marketing' => ['nullable', 'min:3', 'max:3', Rule::unique('collectors', 'marketing')->ignore($userId, 'user_id')],
            'surveyor'  => ['nullable', 'min:3', 'max:3', Rule::unique('collectors', 'surveyor')->ignore($userId, 'user_id')],
            'funding'   => ['nullable', 'min:3', 'max:3', Rule::unique('collectors', 'funding')->ignore($userId, 'user_id')],
            'credit'    => ['nullable', 'min:3', 'max:3', Rule::unique('collectors', 'credit')->ignore($userId, 'user_id')],
        ];
    }
}
