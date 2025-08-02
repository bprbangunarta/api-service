<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    protected $saving;
    protected $collector;

    public function __construct($deposit, $saving, $collector)
    {
        parent::__construct($deposit);
        $this->saving = $saving;
        $this->collector = $collector;
    }

    public function toArray(Request $request): array
    {
        return [
            'number'           => $this->number,
            'account'          => $this->account,
            'name'             => $this->saving->name,
            'address'          => $this->saving->address,
            'source'           => $this->source,
            'amount'           => $this->amount,
            'previous_balance' => $this->previous_balance,
            'ending_balance'   => $this->ending_balance,
            'description'      => $this->description,
            'collector'        => $this->collector->user->name,
            'time'             => date('Y-m-d H:i:s', strtotime($this->created_at)),

        ];
    }
}
