<?php

namespace App\Repositories;

use App\Models\UserLog;

class UserLogRepository
{
    public function read_all()
    {
        return UserLog::all();
    }

    public function read_filter($userId)
    {
        return UserLog::where('user_id', $userId)->get();
    }

    public function create_data(array $data)
    {
        return UserLog::create($data);
    }
}
