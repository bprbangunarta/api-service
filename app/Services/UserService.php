<?php

namespace App\Services;

use App\Models\Collector;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function __construct(
        protected UserRepository $userRepo,
        protected UserLogService $userlogService
    ) {}

    public function readAll()
    {
        return $this->userRepo->read_all();
    }

    public function readFilter($search = '', $show = 10)
    {
        return $this->userRepo->read_filter($search, $show);
    }

    public function createData(array $request): void
    {
        DB::beginTransaction();

        try {
            $data = [
                'name'     => Str::title($request['name']),
                'username' => Str::lower($request['username']),
                'email'    => Str::lower($request['email']),
                'phone'    => $request['phone'],
                'office'   => $request['office'],
                'password' => Hash::make(12345),
            ];

            $user = $this->userRepo->create_data($data);
            $user->assignRole($request['role']);
            Collector::create(['user_id' => $user->id]);

            $this->userlogService->createData('Create Data User');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function readId(string $id)
    {
        try {
            return $this->userRepo->read_id($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findByUsername(string $username)
    {
        try {
            return $this->userRepo->find_username($username);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateData(string $id, array $request): void
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepo->read_id($id);

            $data = [
                'name'     => Str::title($request['name']),
                'username' => Str::lower(Str::slug($request['username'])),
                'email'    => Str::lower($request['email']),
                'phone'    => $request['phone'],
                'office'   => $request['office'],
            ];

            if (!empty($request['password'])) {
                $data['password'] = Hash::make($request['password']);
            }

            $this->userRepo->update_data($user, $data);
            $user->syncRoles($request['role']);

            $this->userlogService->createData('Update Data User');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteData(string $id): void
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepo->read_id($id);

            $this->userRepo->delete_data($user);

            $this->userlogService->createData('Delete Data User');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function restoreData(string $id): void
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepo->read_id($id);

            $this->userRepo->restore_data($user);

            $this->userlogService->createData('Restore Data User');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
