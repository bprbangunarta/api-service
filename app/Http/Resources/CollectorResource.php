<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'person'    => $this->person,
            'marketing' => $this->marketing,
            'surveyor'  => $this->surveyor,
            'funding'   => $this->funding,
            'credit'    => $this->credit,
        ];
    }
}
