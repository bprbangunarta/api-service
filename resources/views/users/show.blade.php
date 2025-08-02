@extends('layouts.app')
@section('title', 'Manage Users')

@section('page-header')
<div class="page-header d-print-none mt-3">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Master Data</div>
                <h2 class="page-title">@yield('title')</h2>
            </div>

            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('user.index') }}" class="btn btn-2 btn-5 d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l4 4" />
                            <path d="M5 12l4 -4" />
                        </svg>
                        Back
                    </a>

                    <a href="{{ route('user.index') }}" class="btn btn-2 btn-6 d-sm-none btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l4 4" />
                            <path d="M5 12l4 -4" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-body')
<div class="page-body mt-2">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <!-- content -->
            <div class="col-12">
                <div class="card">
                    <form method="POST" action="{{ route('user.update', Crypt::encryptString($data['user']->id)) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Full Name</label>
                                        <input type="text" class="form-control text-capitalize" name="name" id="name" value="{{ $data['user']->name }}" />

                                        @error('name')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Username</label>
                                        <input type="text" class="form-control text-lowercase" name="username" id="username" value="{{ $data['user']->username }}" />

                                        @error('username')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Email Address</label>
                                        <input type="email" class="form-control text-lowercase" name="email" id="email" value="{{ $data['user']->email }}" />

                                        @error('email')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">No. Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-text">62</span>
                                            <input type="number" class="form-control" name="phone" id="phone" value="{{ $data['user']->phone }}" />
                                        </div>

                                        @error('phone')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Role</label>
                                        <select class="form-select" name="role" id="role">
                                            <option value=""></option>
                                            @foreach ($data['roles']->where('guard_name', 'web') as $item)
                                            <option value="{{ e($item['name']) }}" {{ $data['user']->getRoleNames()->implode(', ') === $item['name'] ? 'selected' : '' }}>
                                                {{ e($item['name']) }}
                                            </option>
                                            @endforeach
                                        </select>

                                        @error('role')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Office</label>
                                        <select class="form-select" name="office" id="office">
                                            <option value=""></option>
                                            @foreach ($data['offices'] as $item)
                                            <option value="{{ e($item['code']) }}" {{ $data['user']->office === $item['code'] ? 'selected' : '' }}>
                                                {{ Str::title(e($item['name'])) }}
                                            </option>
                                            @endforeach
                                        </select>

                                        @error('office')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Password</label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="(Optional)" />
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
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-2" id="btn-submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                Save
                            </button>

                            @if ($data['user']->deleted_at)
                            <a class="btn btn-success btn-2" data-bs-toggle="modal" data-bs-target="#modal-restore-user">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-restore me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3.06 13a9 9 0 1 0 .49 -4.087" />
                                    <path d="M3 4.001v5h5" />
                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                </svg>
                                Restore
                            </a>
                            @else
                            <a class="btn btn-danger btn-2" data-bs-toggle="modal" data-bs-target="#modal-delete-user">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                Delete
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <form method="POST" action="{{ route('collector.update', Crypt::encryptString($data['user']->id)) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-xl-4 col-md-4 col-sm-6">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Alias</label>
                                        <input type="text" class="form-control" name="person" id="person" minlength="3" maxlength="3" value="{{ $data['user']->collector->person }}" />

                                        @error('person')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-2 col-md-2 col-sm-6">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Marketing</label>
                                        <input type="text" class="form-control" name="marketing" id="marketing" minlength="3" maxlength="3" value="{{ $data['user']->collector->marketing }}" />

                                        @error('marketing')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-2 col-md-2 col-sm-6">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Surveyor</label>
                                        <input type="text" class="form-control" name="surveyor" id="surveyor" minlength="3" maxlength="3" value="{{ $data['user']->collector->surveyor }}" />

                                        @error('surveyor')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-2 col-md-2 col-sm-6">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Funding</label>
                                        <input type="text" class="form-control" name="funding" id="funding" minlength="3" maxlength="3" value="{{ $data['user']->collector->funding }}" />

                                        @error('funding')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-2 col-md-2 col-sm-6">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Credit</label>
                                        <input type="text" class="form-control" name="credit" id="credit" minlength="3" maxlength="3" value="{{ $data['user']->collector->credit }}" />

                                        @error('credit')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            @if ($data['user']->deleted_at)
                            <button type="submit" class="btn btn-primary btn-2" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                Save
                            </button>
                            @else
                            <button type="submit" class="btn btn-primary btn-2" id="btn-submit2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                Save
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('users._modal-show')
@endsection

@push('css')
<link href="{{ asset('libs/tom-select/dist/css/tom-select.bootstrap5.min.css?1744816593') }}" rel="stylesheet" />
@endpush

@push('js')
<script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js?1744816593') }}" defer></script>

@if ($errors->has('delete_user'))
<script>
    $(document).ready(function() {
        $('#modal-delete-user').modal('show');
    });
</script>
@elseif ($errors->has('restore_user'))
<script>
    $(document).ready(function() {
        $('#modal-restore-user').modal('show');
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

    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('role'), {
            placeholder: "Pilih Opsi",
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
        }));
    });

    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('office'), {
            placeholder: "Pilih Opsi",
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
        }));
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('btn-submit');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('btn-submit2');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        $('#form-delete-user').submit(function(event) {
            var submitButton = $('#btn-delete-user');
            submitButton.prop('disabled', true);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        $('#form-restore-user').submit(function(event) {
            var submitButton = $('#btn-restore-user');
            submitButton.prop('disabled', true);
        });
    });
</script>
@endpush