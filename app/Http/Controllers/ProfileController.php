<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentSessionId = session()->getId();

        $rawSessions = DB::table('sessions')
            ->whereNotNull('user_id')
            ->where('user_id', $user->id)
            ->orderByDesc('last_activity')
            ->get();

        $sessions = $rawSessions->map(function ($session) use ($currentSessionId) {
            $userAgent = $session->user_agent;

            // Deteksi OS
            if (Str::contains($userAgent, 'Mac OS X')) {
                $os = 'OS X';
            } elseif (Str::contains($userAgent, 'Windows')) {
                $os = 'Windows';
            } elseif (Str::contains($userAgent, 'Linux')) {
                $os = 'Linux';
            } else {
                $os = 'Unknown OS';
            }

            // Deteksi browser
            if (Str::contains($userAgent, 'Chrome')) {
                $browser = 'Chrome';
            } elseif (Str::contains($userAgent, 'Firefox')) {
                $browser = 'Firefox';
            } elseif (Str::contains($userAgent, 'Safari') && !Str::contains($userAgent, 'Chrome')) {
                $browser = 'Safari';
            } elseif (Str::contains($userAgent, 'Edge')) {
                $browser = 'Edge';
            } else {
                $browser = 'Unknown Browser';
            }

            return [
                'os' => $os,
                'browser' => $browser,
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $currentSessionId,
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });

        $data = [
            'user'     => $user,
            'sessions' => $sessions
        ];

        return view('profile.index', compact('data'));
    }

    public function changeInformation(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone'     => ['nullable', 'max:12', Rule::unique('users')->ignore($user->id)],
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'name'      => Str::title($request->name),
                'username'  => Str::lower($request->username),
                'email'     => Str::lower($request->email),
                'phone'     => $request->phone,
            ];
            $user->update($data);

            DB::commit();

            return redirect()->back()->with('success', 'Successfully changed profile information');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Change Information: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to change profile information');
        }
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required|current_password',
            'password'         => 'required|string|min:5|confirmed',
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'password' => Hash::make($request->password),
            ];

            $user->update($data);

            DB::commit();

            return redirect()->back()->with('success', 'Successfully changed password');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Change Password: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to change password');
        }
    }

    public function logoutSession(Request $request)
    {
        $request->validate([
            'browser_session' => ['required', 'current_password'],
        ]);

        $user = Auth::user();
        $currentSessionId = Session::getId();
        try {
            DB::beginTransaction();

            DB::table('sessions')
                ->where('user_id', $user->id)
                ->where('id', '!=', $currentSessionId)
                ->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Successfully logged out of browser session');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Logout Session: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to log out browser session');
        }
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'delete_account' => ['required', 'current_password'],
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $user->delete();

            DB::commit();

            return redirect('/')->with('success', 'Successfully deleted account');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete Account: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to delete account');
        }
    }
}
