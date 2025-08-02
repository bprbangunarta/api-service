<?php

namespace App\Services;

use App\Repositories\UserLogRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserLogService
{
    public function __construct(
        protected UserLogRepository $userlogRepo,
    ) {}

    public function readAll()
    {
        return $this->userlogRepo->read_all();
    }

    public function readFilter($userId)
    {
        return $this->userlogRepo->read_filter($userId);
    }

    public function createData($description)
    {
        $data = [
            'user_id'     => Auth::id(),
            'ip_address'  => Request::ip(),
            'user_agent'  => Request::header('User-Agent'),
            'url'         => Request::fullUrl(),
            'description' => $description,
        ];

        return $this->userlogRepo->create_data($data);
    }
}
