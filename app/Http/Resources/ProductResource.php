<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    //    ; return parent::toArray($request)
    $lang = request()->header('Accept-Language');


    if ( $lang == 'en')
    {
        return[

        'id' => $this->id,
        'name' => $this->name_en,

  'description' => $this->description_en,
  'category' => $this->category_id,

        ];
    }
    else if ( $lang == 'ar') {
        return[
            'id' => $this->id,

     'name' => $this->name_ar,

     'description' => $this->description_ar,
     'category' => $this->category_id,
    ];
    }

    }
}
