<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class McqtItemResource extends JsonResource
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
            'id' => $this->id,
            'subcategory_id' => $this->subcategory_id,
            'question' => $this->question,
            'choices' => $this->choices,
            'answer' => $this->answer,
            'explanation' => $this->explanation,
        ];
    }
}
