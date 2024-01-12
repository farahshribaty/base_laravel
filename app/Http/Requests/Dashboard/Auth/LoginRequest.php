<?php

namespace App\Http\Requests\Dashboard\Auth;

use App\Http\Requests\Base\BaseRequestForm;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends BaseRequestForm
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
            // 'email' => 'required|email|exists:admins,email',
            // 'password' => 'required|string|max:255|min:8',
        ];
    }
}
