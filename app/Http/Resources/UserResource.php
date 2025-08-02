<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'     => $this->name,
            'username' => $this->username,
            'email'    => $this->email,
            'phone'    => $this->phone,
            'office'   => $this->office,
            'collector' => new CollectorResource($this->whenLoaded('collector')),
            'coa'       => new CoaResource($this->whenLoaded('coa')),
        ];
    }
}
