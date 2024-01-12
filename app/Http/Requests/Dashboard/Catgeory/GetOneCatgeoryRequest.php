<?php

namespace App\Http\Requests\Dashboard\Catgeory;

use App\Http\Requests\Base\BaseRequestForm;

class GetOneCatgeoryRequest extends BaseRequestForm
{
    

    public function rules()
    {
        return [
            'category_id'=>'required'
        ];
    }
}