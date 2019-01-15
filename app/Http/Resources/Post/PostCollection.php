<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\Resource;

class PostCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
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
                    'review'    => route('posts.show' , $this->id),
//                    'delete'    => route('posts.destroy' , $this->id .'/destroy')
                ]



            ];

    }
}
