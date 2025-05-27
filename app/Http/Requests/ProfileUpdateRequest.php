<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        'username' => ['nullable', 'string', 'max:255'],
        'birthday' => ['nullable', 'date'],
        'about_me' => ['nullable', 'string'],
        'profile_picture' => ['nullable', 'image', 'max:2048'],
        'name' => ['string', 'max:255'],
        'email' => ['email', 'max:255'],
    ];
}
}
