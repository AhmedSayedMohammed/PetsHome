<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Doctor extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
        return[
                'id'=>$this->id,
                'rate'=>$this->rate,
                'user_id'=>$this->user_id,
                'user'=>$this->user,
        ];
    }
}
