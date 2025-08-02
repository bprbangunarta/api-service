<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'number'         => $this->number,
            'office'         => $this->office,
            'collector_code' => $this->collector_code,
            'account'        => $this->account,
            'source'         => $this->source,
            'amount'         => $this->amount,
            'description'    => $this->description,
            'time'           => date('Y-m-d H:i:s', strtotime($this->created_at)),
        ];
    }
}
