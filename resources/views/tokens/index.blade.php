@extends('layouts.app')
@section('title', 'Manage Tokens')

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
                    @if (request('search'))
                    <a href="{{ route('token.index') }}" class="btn btn-icon btn-danger" style="margin-right: -5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 7l16 0" />
                            <path d="M10 11l0 6" />
                            <path d="M14 11l0 6" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                    </a>
                    @endif

                    <button class="btn btn-primary btn-5 d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add
                    </button>

                    <button class="btn btn-primary btn-6 d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </button>
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
                    <div class="card-body border-bottom py-3">
                        <form action="{{ route('token.index') }}" method="GET">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <select class="form-select form-select-sm text-center" name="show" onchange="this.form.submit()">
                                            @foreach ([10, 25, 50, 100] as $val)
                                            <option value="{{ $val }}" {{ request('show', 10) == $val ? 'selected' : '' }}>
                                                {{ $val }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    entries
                                </div>
                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" name="search" id="search" value="{{ request('search') }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th width="5%">no</th>
                                    <th>name</th>
                                    <th>token</th>
                                    <th>type</th>
                                    <th>expired</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['tokens'] as $index => $item)
                                <tr class="text-{{ $item->deleted_at ? 'danger' : 'reset' }}">
                                    <td>{{ ($data['tokens']->currentPage() - 1) * $data['tokens']->perPage() + $index + 1 }}</td>
                                    <td><a href="{{ route('token.show', Crypt::encryptString($item->id)) }}" class="text-reset d-block">{{ Str::title($item->name) }}</a></td>
                                    <td> {{ Str::limit($item->token, 90) }}</td>
                                    <td>{{ Str::title($item->type) }}</td>
                                    <td>{{ Str::title(gmdate('j \d\a\y\s', $item->expires_in)) }}</td>
                                    <td>
                                        <input type="text" id="token-{{ $item->id }}" value="{{ $item->token }}" hidden>
                                        <a href="javascript:void(0);" onclick="copyToClipboard('token-{{ $item->id }}')" class="text-secondary ms-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-copy">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                            </svg>
                                        </a>

                                        <a href="#" class="text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="10">No matching data found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- pagination -->
                    {{ $data['tokens']->withQueryString()->onEachSide(0)->links('layouts.paging') }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('tokens._modal')
@endsection

@push('js')

@if ($errors->has('name'))
<script>
    $(document).ready(function() {
        $('#modal-add').modal('show');
    });
</script>
@endif

<script>
    function copyToClipboard(elementId) {
        const inputElement = document.getElementById(elementId);
        const text = inputElement.value;

        navigator.clipboard.writeText(text).then(function() {
            alert('Token copied to clipboard!');
        }, function(err) {
            alert('Failed to copy text: ' + err);
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#form-add-token').submit(function(event) {
            var submitButton = $('#btn-submit');
            submitButton.prop('disabled', true);
        });
    });
</script>
@endpush