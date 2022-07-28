<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, string>
     */
    public function toArray($request):array
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar ? Storage::disk("public")->url($this->avatar) : null,
            'full_name' => $this->first_name." ".$this->last_name,
            'email' => $this->email,
        ];
    }
}
