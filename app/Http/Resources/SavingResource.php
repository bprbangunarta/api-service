<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SavingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'account'        => $this->account,
            'name'           => $this->name,
            'address'        => $this->address,
            'balance'        => $this->balance,
            'collector_code' => $this->collector_code,

        ];
    }
}
