@extends('layouts.auth')
@section('title', 'Authentication')

@section('page-body')
<div class="card card-md">
    <div class="card-body">
        <div class="text-center">
            <h2>@yield('title')</h2>
            <div class="text-secondary">Please log in to your account with your registered email and password.</div>
        </div>

        <div class="hr-text hr-text-center">Data Input</div>

        <form method="POST" action="#" autocomplete="off" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label mb-1">Username</label>
                <input type="text" class="form-control" name="auth" id="auth" placeholder="Email atau Username" value="{{ old('auth') }}" />

                @error('auth')
                <span class="form-check-description text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label mb-1">Password</label>

                <div class="input-group input-group-flat">
                    <input type="password" class="form-control" name="password" id="password" placeholder="********************" />
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

            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-4 w-100" id="btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-fingerprint">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" />
                        <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" />
                        <path d="M12 11v2a14 14 0 0 0 2.5 8" />
                        <path d="M8 15a18 18 0 0 0 1.8 6" />
                        <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" />
                    </svg>
                    Authentication
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const emailInput = document.getElementById("auth");
        if (emailInput) {
            emailInput.addEventListener("input", function() {
                this.value = this.value.toLowerCase();
            });
        }
    });

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
        const form = document.querySelector('form');
        const submitButton = document.getElementById('btn-submit');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
        });
    });
</script>
@endpush