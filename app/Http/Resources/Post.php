<?php

namespace App\Http\Resources;
use User as UserResource;
use App\User;
use App\Comment;
use App\Post as PostModel;
use App\Http\Resources\Comment  as CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user' => $this->user,
            'comments'=>CommentResource::collection($this->comments),
            'likes'=>$this->likes,
            'liked'=>false,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
