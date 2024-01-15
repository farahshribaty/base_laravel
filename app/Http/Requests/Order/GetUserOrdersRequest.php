<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Base\BaseRequestForm;

class GetUserOrdersRequest extends BaseRequestForm
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
            'per_page' => 'nullable|integer|max:50|min:1',
        ];
    }
}
