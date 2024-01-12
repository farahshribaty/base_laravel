<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->cart->id,
            "user_id"=>$this->cart->user_id,
            "sub_total"=>$this->cart->sub_total,
            "delivery_fees"=>$this->cart->delivery_fees,
            "overall_total"=>$this->cart->overall_total,
            "cart_items_count"=>$this->cart->cart_items_count,
        ];
    }
}
