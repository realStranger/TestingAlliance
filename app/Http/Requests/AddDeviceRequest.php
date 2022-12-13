<?php

namespace App\Http\Requests;

use App\DTO\DeviceDTO;
use Illuminate\Foundation\Http\FormRequest;

class AddDeviceRequest extends FormRequest
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
            'login' => 'required',
            'password' => 'required',
            'name' => 'required'
        ];
    }

    public function getDto(): DeviceDTO
    {
        return new DeviceDTO(
            $this->get('login'),
            $this->get('password'),
            $this->get('name')
        );
    }
}
