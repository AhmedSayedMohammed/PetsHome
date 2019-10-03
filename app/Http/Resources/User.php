<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Doctor  as DoctorResource;
class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        [
            'id'=>$this->id,
            'type'=>$this->type,
            'name'=>$this->name,
            'avatar'=>$this->avatar,
            'doctor'=>$this->doctor,
            'consultation'=>$this->consultations,
            'posts'=>$this->posts,
            'comments'=>$this->comments,

        ];
    }
}
