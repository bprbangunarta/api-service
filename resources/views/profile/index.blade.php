@extends('layouts.app')
@section('title', 'Profile')

@section('page-header')
<div class="page-header d-print-none mt-3">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">@yield('title')</div>
                <h2 class="page-title">Kelola Akun</h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-body')
<div class="page-body mt-2">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <!-- Informasi Profil -->
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-12 col-lg-4">
                        <div class="card-body mb-2">
                            <h3 class="mb-0">Profile Information</h3>
                            <span class="text-secondary">Update your profile information and account email address.</span>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-8">
                        <div class="card mb-4">
                            <form method="POST" action="{{ route('profile.change-information') }}" id="form-change-profile">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-xl-6 col-md-12 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label mb-0">Full name</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $data['user']->name) }}" />

                                                @error('name')
                                                <span class="form-check-description text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-md-12 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label mb-0">Username</label>
                                                <input type="text" class="form-control text-lowercase" name="username" id="username" value="{{ old('username', $data['user']->username) }}" />

                                                @error('username')
                                                <span class="form-check-description text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-xl-6 col-md-12 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label mb-0">Email Address</label>
                                                <input type="email" class="form-control text-lowercasep" name="email" id="email" value="{{ old('email', $data['user']->email) }}" />

                                                @error('email')
                                                <span class="form-check-description text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-md-12 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label mb-0">No. Phone</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">62</span>
                                                    <input type="number" class="form-control" name="phone" id="phone" value="{{ old('phone', $data['user']->phone) }}" />
                                                </div>

                                                @error('phone')
                                                <span class="form-check-description text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-2" id="btn-chage-profile">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy me-1">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M14 4l0 4l-6 0l0 -4" />
                                        </svg>
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Perbarui Kata Sandi -->
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-12 col-lg-4">
                        <div class="card-body mb-2">
                            <h3 class="mb-0">Update Password</h3>
                            <span class="text-secondary">Make sure your account uses a long, random password to keep it secure.</span>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-8">
                        <div class="card mb-4">
                            <form method="POST" action="{{ route('profile.change-password') }}" id="form-change-password">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-xl-6 col-md-12 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Current Password</label>
                                                <div class="input-group input-group-flat">
                                                    <input type="password" class="form-control" name="current_password" id="current_password" />
                                                    <span class="input-group-text mb-0">
                                                        <a href="#" class="link-secondary" data-toggle="current_password">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                            </svg>
                                                        </a>
                                                    </span>
                                                </div>

                                                @error('current_password')
                                                <span class="form-check-description text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-xl-6 col-md-12 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label mb-1">New Password</label>
                                                <div class="input-group input-group-flat">
                                                    <input type="password" class="form-control" name="password" id="password" />
                                                    <span class="input-group-text mb-0">
                                                        <a href="#" class="link-secondary" data-toggle="password">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                            </svg>
                                                        </a>
                                                    </span>
                                                </div>

                                                @error('password')
                                                <span class="form-check-description text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-md-12 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Confirm Password</label>
                                                <div class="input-group input-group-flat">
                                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" />
                                                    <span class="input-group-text mb-0">
                                                        <a href="#" class="link-secondary" data-toggle="password_confirmation">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                            </svg>
                                                        </a>
                                                    </span>
                                                </div>

                                                @error('password_confirmation')
                                                <span class="form-check-description text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-2" id="btn-change-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy me-1">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M14 4l0 4l-6 0l0 -4" />
                                        </svg>
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sesi Browser -->
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-12 col-lg-4">
                        <div class="card-body mb-2">
                            <h3 class="mb-0">Browser Sessions</h3>
                            <span class="text-secondary">Manage and log out of your active sessions across browsers and other devices.</span>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <span class="text-secondary">
                                    If necessary, you can log out of all other browser sessions on all your devices. Your last few sessions are listed below; however, this list may not be complete. If you think your account has been compromised, you should also update your password.
                                </span>

                                <div class="list-group list-group-flush overflow-auto mt-3" style="max-height: 35rem">
                                    @foreach ($data['sessions'] as $session)
                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="avatar avatar-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-imac">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M3 4a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-12z" />
                                                        <path d="M3 13h18" />
                                                        <path d="M8 21h8" />
                                                        <path d="M10 17l-.5 4" />
                                                        <path d="M14 17l.5 4" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div class="col text-truncate">
                                                <div class="text-body d-block">{{ $session['os'] }} - {{ $session['browser'] }}</div>
                                                <small class="text-secondary text-truncate mt-n1"> {{ $session['ip_address'] }},
                                                    @if ($session['is_current_device'])
                                                    <font class="text-success">This device</font>
                                                    @else
                                                    Last active {{ $session['last_active'] }}
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <a class="btn btn-primary btn-2" data-bs-toggle="modal" data-bs-target="#modal-browser-session">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2 me-1">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                            <path d="M15 12h-12l3 -3" />
                                            <path d="M6 15l-3 -3" />
                                        </svg>
                                        Exit Another Session
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hapus Akun -->
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-12 col-lg-4">
                        <div class="card-body mb-2">
                            <h3 class="mb-0">Delete Account</h3>
                            <span class="text-secondary">Permanently delete your account.</span>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <span class="text-secondary">
                                    Once an account is deleted, all of its resources and data will be permanently deleted. Before deleting this account, please download any data or information related to this account that you wish to keep.
                                </span>

                                <div class="mt-4">
                                    <a class="btn btn-danger btn-2" data-bs-toggle="modal" data-bs-target="#modal-delete-account">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash me-1">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                        Delete Account
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('profile._modal')
@endsection

@push('js')
@if ($errors->has('browser_session'))
<script>
    $(document).ready(function() {
        $('#modal-browser-session').modal('show');
    });
</script>
@elseif ($errors->has('delete_account'))
<script>
    $(document).ready(function() {
        $('#modal-delete-account').modal('show');
    });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleLinks = document.querySelectorAll('a[data-toggle]');

        toggleLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-toggle');
                const input = document.getElementById(targetId);

                if (input) {
                    input.type = input.type === 'password' ? 'text' : 'password';
                    this.classList.toggle('text-primary');
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const forms = [{
                formId: 'form-change-profile',
                buttonId: 'btn-chage-profile'
            },
            {
                formId: 'form-change-password',
                buttonId: 'btn-change-password'
            },
            {
                formId: 'form-2fa',
                buttonId: 'btn-2fa'
            },
        ];

        forms.forEach(({
            formId,
            buttonId
        }) => {
            const form = document.getElementById(formId);
            const button = document.getElementById(buttonId);

            if (form && button) {
                form.addEventListener('submit', function() {
                    button.disabled = true;
                });
            }
        });

        $('#form-browser-session').submit(function(event) {
            var submitButton = $('#btn-browser-session');
            submitButton.prop('disabled', true);
        });

        $('#form-delete-account').submit(function(event) {
            var submitButton = $('#btn-delete-account');
            submitButton.prop('disabled', true);
        });
    });
</script>
@endpush