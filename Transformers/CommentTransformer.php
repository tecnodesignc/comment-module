<?php

namespace Modules\Comments\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserTransformer;

use Illuminate\Support\Arr;

class CommentTransformer extends JsonResource
{
  public function toArray($request)
  {
    $data = [
      'id' => $this->when($this->id, $this->id),
      'comment' => $this->when($this->comment, $this->comment),
      'options' => $this->when($this->options, $this->options),
      'user' => new UserTransformer($this->whenLoaded('commenter')),
      'commentableType' => $this->when($this->presencommentable_type, $this->commentable_type),
      'createdAt' => $this->when($this->created_at, $this->created_at),
      'updatedAt' => $this->when($this->updated_at, $this->updated_at),
    ];


    return $data;

  }
}
