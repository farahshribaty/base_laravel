<?php

namespace App\Http\Requests\Dashboard\User4;

use App\Http\Requests\Base\BaseRequestForm;

class GetOneUser4Request extends BaseRequestForm
{
    

    public function rules()
    {
        return [
            'user4_id' => 'required|exists:users,id',
        ];
    }
}