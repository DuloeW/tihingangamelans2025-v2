<?php

namespace App\Http\Requests;

use App\Models\Pengguna;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


// use App\Http\Requests

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(pengguna::class)->ignore($this->user()->id, 'pengguna_id'),
            ],

            'user_name' => ['required', 'string', 'max:50'],
            'no_telephone' => ['nullable', 'string', 'max:15'],
            'province_code' => ['required'],
            'city_code' => ['required'],
            'district_code' => ['required'],
        ];
    }
}
