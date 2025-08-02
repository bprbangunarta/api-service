@extends('layouts.app')
@section('title', 'Manage Clients')

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
                    <a href="{{ route('client.index') }}" class="btn btn-2 btn-5 d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l4 4" />
                            <path d="M5 12l4 -4" />
                        </svg>
                        Back
                    </a>

                    <a href="{{ route('client.index') }}" class="btn btn-2 btn-6 d-sm-none btn-icon">
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
                    <form method="POST" action="{{ route('client.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Client Name</label>
                                        <input type="text" class="form-control" name="client_name" id="client_name" value="{{ old('client_name') }}" />

                                        @error('client_name')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Client ID</label>
                                        <input type="text" class="form-control" name="client_id" id="client_id" placeholder="(Automatic)" disabled />

                                        @error('client_id')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Client Key</label>
                                        <input type="text" class="form-control" name="client_key" id="client_key" placeholder="(Automatic)" disabled />

                                        @error('client_key')
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