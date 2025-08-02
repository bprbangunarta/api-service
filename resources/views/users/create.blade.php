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
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Full Name</label>
                                        <input type="text" class="form-control text-capitalize" name="name" id="name" value="{{ old('name') }}" />

                                        @error('name')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Username</label>
                                        <input type="text" class="form-control text-lowercase" name="username" id="username" value="{{ old('username') }}" />

                                        @error('username')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Email Address</label>
                                        <input type="email" class="form-control text-lowercase" name="email" id="email" value="{{ old('email') }}" />

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
                                            <input type="number" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" />
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
                                            <option value="{{ e($item['name']) }}" {{ old('role') === $item['name'] ? 'selected' : '' }}>
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
                                            <option value="{{ e($item['code']) }}" {{ old('office') === $item['name'] ? 'selected' : '' }}>
                                                {{ Str::title(e($item['name'])) }}
                                            </option>
                                            @endforeach
                                        </select>

                                        @error('office')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-2" id="btn-submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="{{ asset('libs/tom-select/dist/css/tom-select.bootstrap5.min.css?1744816593') }}" rel="stylesheet" />
@endpush

@push('js')
<script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js?1744816593') }}" defer></script>

<script>
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
</script>
@endpush