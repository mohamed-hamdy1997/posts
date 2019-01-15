<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'post_image' => $this->post_image,
            'post_video' => $this->post_video,
            'post_file' => $this->post_file,
            'created_at' => $this->created_at,
            'post_owner' => $this->post_owner,
            'href'       =>[
                'edit'    => route('posts.edit' , $this->id ),

                 'delete'    => route('posts.destroy' , $this->id .'/destroy')

                ]



        ];
    }
}
