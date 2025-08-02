<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\OfficeService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected RoleService $roleService,
        protected OfficeService $officeService
    ) {}

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $show   = $request->input('show', 10);

        $users = $this->userService->readFilter($search, $show);

        $data = [
            'users' => $users,
        ];

        return view('users.index', compact('data'));
    }

    public function create()
    {
        $roles   = $this->roleService->readAll();
        $offices = $this->officeService->readAll();

        $data = [
            'roles'   => $roles,
            'offices' => $offices,
        ];

        return view('users.create', compact('data'));
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $this->userService->createData($request->validated());

            return redirect()->back()->with('success', 'Successfully saved data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving data');
        }
    }

    public function show($id)
    {
        try {
            $id      = Crypt::decryptString($id);
            $user    = $this->userService->readId($id);
            $roles   = $this->roleService->readAll();
            $offices = $this->officeService->readAll();

            $data = [
                'user'    => $user,
                'roles'   => $roles,
                'offices' => $offices,
            ];

            return view('users.show', compact('data'));
        } catch (\Throwable $e) {
            if ($e instanceof DecryptException || $e instanceof \RuntimeException) {
                Log::error('MANAGE USER-SHOW: ', ['exception' => $e]);
                return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
            }

            Log::error('MANAGE USER-SHOW: ', ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while retrieving data');
        }
    }

    public function update(string $id, UserUpdateRequest $request)
    {
        try {
            $id = Crypt::decryptString($id);
            $this->userService->updateData($id, $request->validated());

            return redirect()->back()->with('success', 'Successfully changed data');
        } catch (\Throwable $e) {
            if ($e instanceof DecryptException || $e instanceof \RuntimeException) {
                Log::error('MANAGE USER-UPDATE: ', ['exception' => $e]);
                return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
            }

            Log::error('MANAGE USER-UPDATE: ', ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while changing data');
        }
    }

    public function destroy($id, Request $request)
    {
        $request->validate([
            'delete_user' => ['required', 'current_password'],
        ]);

        try {
            $id = Crypt::decryptString($id);
            $this->userService->deleteData($id);

            return redirect()->route('user.index')->with('success', 'Successfully deleted data');
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting data');
        }
    }

    public function restore($id, Request $request)
    {
        $request->validate([
            'restore_user' => ['required', 'current_password'],
        ]);

        try {
            $id = Crypt::decryptString($id);
            $this->userService->restoreData($id);

            return redirect()->route('user.index')->with('success', 'Successfully recovered data');
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Sorry, the ID you entered is invalid');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while restoring data');
        }
    }
}
