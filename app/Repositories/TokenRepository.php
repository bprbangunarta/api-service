<?php

namespace App\Repositories;

use App\Models\Office;
use App\Models\Token;

class TokenRepository
{
    public function read_all()
    {
        return Token::orderBy('id', 'DESC')->get();
    }

    public function read_filter($search = '', $show = 10)
    {
        $client = Token::query();

        if ($search) {
            $client->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        }

        return $client->orderBy('id', 'DESC')->paginate($show);
    }

    public function read_id($id)
    {
        return Token::findOrFail($id);
    }

    public function create_data(array $data): Token
    {
        return Token::create($data);
    }

    public function last_token()
    {
        return Token::latest('id')->value('token');
    }
}
