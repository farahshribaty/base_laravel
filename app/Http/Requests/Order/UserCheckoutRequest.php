<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Base\BaseRequestForm;
use GuzzleHttp\Psr7\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserCheckoutRequest extends BaseRequestForm
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
        $paymentMethod = $this->input('payment_method');

        if (in_array($paymentMethod, ["online", "cash_on_delivery"])) {
            if ($paymentMethod == "online")
                return [
                'payment_id' => 'required|integer|exists:payments,id',
                'zone_number' => 'required|numeric',
                'lat' => 'required|string',
                'long' => 'required|string',
                'street' => 'nullable|string|max:500|min:3',
                'building_number' => 'nullable|string|max:500|min:1',
                ];   
            
            else 
                return [
                    'payment_method' => ['required', Rule::in(["online", "cash_on_delivery"])],
                    'zone_number' => 'required|numeric',
                    'lat' => 'required|string',
                    'long' => 'required|string',
                    'street' => 'nullable|string',
                    'building_number' => 'nullable|string',
                ];
                    
        } else{
            return [
                'payment_method' => ['required', Rule::in(["online", "cash_on_delivery"])],
                'payment_id' => 'required|integer|exists:payments,id',
                'zone_number' => 'required|numeric',
                'lat' => 'required|string',
                'long' => 'required|string',
                'street' => 'nullable|string|max:500|min:3',
                'building_number' => 'nullable|string|max:500|min:1',
            ];
        }
    }
}
