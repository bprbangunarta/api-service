<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    public function read_all()
    {
        return Client::orderBy('name')->get();
    }

    public function read_filter($search = '', $show = 10)
    {
        $client = Client::withTrashed();

        if ($search) {
            $client->where(function ($query) use ($search) {
                $query->where('client_name', 'like', "%$search%");
            });
        }

        return $client->orderBy('client_name')->paginate($show);
    }

    public function create_data(array $data): Client
    {
        return Client::create($data);
    }

    public function read_id($id)
    {
        return Client::withTrashed()->findOrFail($id);
    }

    public function update_data(Client $client, array $data): bool
    {
        return $client->update($data);
    }

    public function delete_data(Client $client): bool
    {
        return $client->delete();
    }

    public function restore_data(Client $client): bool
    {
        return $client->restore();
    }
}
