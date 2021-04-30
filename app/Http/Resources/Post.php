<?php

namespace App\Http\Resources;

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
			//return parent::toArray($request);

			return [
				'id' => $this->id,
				'post_title' => $this->post_title,
				'post_author' => $this->author->name,
			];

    }
}
