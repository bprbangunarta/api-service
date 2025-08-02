<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SavingDetailResource extends JsonResource
{
    protected $address;

    public function __construct($resource, $address = null)
    {
        parent::__construct($resource);
        $this->address = $address;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code'          => $this->produk['kode'],
            'product'       => $this->produk['nama'],
            'account'       => $this->norek,
            'name'          => $this->nasabah['nama'] ?? null,
            'address'       => $this->address ?? null,
            'balance'       => [
                'amount'          => $this->saldo['amount'] ?? 0,
                'block'           => $this->saldo['blokir'] ?? 0,
                'effective'       => $this->saldo['efektif'] ?? 0,
                'minimum_balance' => $this->minimum_saldo,
                'minimum_deposit' => $this->minimum_setor,
            ],
        ];
    }
}
