<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, string>
     */
    public function toArray($request)
    {
        return [
            "uuid" => $this->uuid,
            "type" => $this->type,
            "create_at" => $this->uuid,
        ];
    }
}
