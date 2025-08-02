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
                    @if (request('search'))
                    <a href="{{ route('user.index') }}" class="btn btn-icon btn-danger" style="margin-right: -5px;">
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

                    <a class="btn btn-primary btn-5 d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add
                    </a>

                    <a class="btn btn-primary btn-6 d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
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
                    <div class="card-body border-bottom py-3">
                        <form action="{{ route('user.index') }}" method="GET">
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
                                    <th>full name</th>
                                    <th>username</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['users'] as $index => $item)
                                <tr class="text-{{ $item->deleted_at ? 'danger' : 'reset' }}">
                                    <td>{{ ($data['users']->currentPage() - 1) * $data['users']->perPage() + $index + 1 }}</td>
                                    <td><a href="{{ route('user.show', Crypt::encryptString($item->id)) }}" class="text-reset d-block">{{ Str::title($item->name) }}</a></td>
                                    <td>{{ $item->username }}</td>
                                    <td>{!! $item->email_badge !!}{{ $item->email }}</td>
                                    <td>{{ $item->phone ? '62' . $item->phone : '' }}</td>
                                    <td>{{ $item->getRoleNames()->implode(', ') }}</td>
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
                    {{ $data['users']->withQueryString()->onEachSide(0)->links('layouts.paging') }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('users._modal')
@endsection