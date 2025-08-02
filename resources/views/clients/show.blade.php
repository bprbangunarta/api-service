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
                    <form method="POST" action="{{ route('client.update', Crypt::encryptString($data['client']->id)) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Client Name</label>
                                        <input type="text" class="form-control" name="client_name" id="client_name" value="{{ $data['client']->client_name }}" />

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
                                        <input type="text" class="form-control" name="client_id" id="client_id" value="{{ $data['client']->client_id }}" disabled />

                                        @error('client_id')
                                        <span class="form-check-description text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label mb-0">Client Key</label>
                                        <input type="text" class="form-control" name="client_key" id="client_key" value="{{ $data['client']->client_key }}" disabled />

                                        @error('client_key')
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

                            @if ($data['client']->deleted_at)
                            <a class="btn btn-success btn-2" data-bs-toggle="modal" data-bs-target="#modal-restore-client">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-restore me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3.06 13a9 9 0 1 0 .49 -4.087" />
                                    <path d="M3 4.001v5h5" />
                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                </svg>
                                Restore
                            </a>
                            @else
                            <a class="btn btn-danger btn-2" data-bs-toggle="modal" data-bs-target="#modal-delete-client">
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

            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-body border-bottom py-3">
                        <form action="{{ route('client.show', Crypt::encryptString($data['client']->id)) }}" method="GET">
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
                                    <th>address</th>
                                    <th>method</th>
                                    <th>endpoint</th>
                                    <th>response</th>
                                    <th>time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['logs'] as $index => $item)
                                <tr>
                                    <td>{{ $item->ip_address }}</td>
                                    <td>{{ $item->method }}</td>
                                    <td>{{ $item->url }}</td>
                                    <td><span class="badge {{ $item->badge_class }}">{{ $item->response_status }}</span></td>
                                    <td>
                                        <a class="text-reset d-block" data-bs-toggle="modal" data-bs-target="#modal-log" data-id="{{ $item->id }}">
                                            {{ $item->created_at }}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="10">Tidak ditemukan data yang cocok.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- pagination -->
                    {{ $data['logs']->withQueryString()->onEachSide(0)->links('layouts.paging') }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('clients._modal')
@endsection

@push('js')
@if ($errors->has('delete_client'))
<script>
    $(document).ready(function() {
        $('#modal-delete-client').modal('show');
    });
</script>
@elseif ($errors->has('restore_client'))
<script>
    $(document).ready(function() {
        $('#modal-restore-client').modal('show');
    });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('btn-submit');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        $('#form-delete-client').submit(function(event) {
            var submitButton = $('#btn-delete-client');
            submitButton.prop('disabled', true);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        $('#form-restore-client').submit(function(event) {
            var submitButton = $('#btn-restore-client');
            submitButton.prop('disabled', true);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('modal-log');

        document.querySelectorAll('[data-bs-target="#modal-log"]').forEach(link => {
            link.addEventListener('click', function() {
                const logId = this.getAttribute('data-id');

                fetch(`/client-logs/${logId}`)
                    .then(response => response.json())
                    .then(data => {
                        const headerFormatted = JSON.stringify(JSON.parse(data.response_status), null, 4);
                        const bodyFormatted = JSON.stringify(JSON.parse(data.response_body), null, 4);

                        modal.querySelector('.modal-body').innerHTML = `
                            <div class="card-body">
                                <h4>Status Code</h4>
                                <div>
                                    <pre><code>${headerFormatted}</code></pre>
                                </div>
                                <h4>Response Body</h4>
                                <div>
                                    <pre><code>${bodyFormatted}</code></pre>
                                </div>
                            </div>
                        `;
                    })
                    .catch(err => {
                        modal.querySelector('.modal-body').innerHTML = `
                            <div class="alert alert-danger">Gagal mengambil data log.</div>
                        `;
                    });
            });
        });
    });
</script>
@endpush