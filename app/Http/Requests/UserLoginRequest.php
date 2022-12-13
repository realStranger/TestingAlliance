<?php

namespace App\Http\Requests;

use App\DTO\UserLoginDTO;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'User doesn\'t exist'
        ];
    }

    public function getDto(): UserLoginDTO
    {
        return new UserLoginDTO(
            $this->get('email'),
            $this->get('password')
        );
    }
}
