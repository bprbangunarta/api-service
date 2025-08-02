<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function read_all()
    {
        return User::orderBy('name')->get();
    }

    public function read_filter($search = '', $show = 10)
    {
        $users = User::withTrashed();

        if ($search) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('username', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhereHas('roles', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            });
        }

        return $users->orderBy('name')->paginate($show);
    }

    public function create_data(array $data): User
    {
        return User::factory()->create($data);
    }

    public function read_id($id)
    {
        return User::withTrashed()->findOrFail($id);
    }

    public function find_username($username)
    {
        return User::with('collector')->where('email', $username)->orWhere('username', $username)->first();
    }

    public function update_data(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function delete_data(User $user): bool
    {
        return $user->delete();
    }

    public function restore_data(User $user): bool
    {
        return $user->restore();
    }
}
