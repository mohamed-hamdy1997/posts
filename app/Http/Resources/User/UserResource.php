<?php

namespace App\Http\Resources\User;

use App\User;
use App\Post;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'type' => $this->type,

            'posts' => Post::all()->where('user_id', $this->id),

            'href'       =>[
                'delete user'    => route('users.destroy' , $this->id .'/destroy')
            ]
        ];
    }
}
