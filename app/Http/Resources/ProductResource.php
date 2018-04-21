<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        if (is_array($request) || is_object($request)) {
            foreach ($request as $value) {
                $data = [
                    'name' => $value->name,
                    'description' => $value->description,
                    'image' => $value->getImage(),
                ];
                return $data;
            }
        }
        return [
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->getImage(),
        ];
    }
}
