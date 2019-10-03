<?php

namespace App\Http\Resources;
use App\Http\Resources\Doctor as DoctorResource;
use App\Http\Resources\ConsultationComment as CommentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Consultation extends JsonResource
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
                'price'=>$this->price,
                'body'=>$this->body,
                'image'=>$this->image,
                'doctor'=>new DoctorResource($this->doctor),
                'user'=>$this->user,
                'comments'=>CommentsResource::collection($this->comments),
             
                
        ];
    }
}
