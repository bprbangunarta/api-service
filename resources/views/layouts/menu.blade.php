<li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
            </svg>
        </span>
        <span class="nav-link-title"> Dashboard </span>
    </a>
</li>

<li class="nav-item dropdown {{ Route::is('user.*', 'client.*', 'token.*') ? 'active' : '' }}">
    <a class="nav-link dropdown-toggle" href="#navbar-sample" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cube">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M21 16.008v-8.018a1.98 1.98 0 0 0 -1 -1.717l-7 -4.008a2.016 2.016 0 0 0 -2 0l-7 4.008c-.619 .355 -1 1.01 -1 1.718v8.018c0 .709 .381 1.363 1 1.717l7 4.008a2.016 2.016 0 0 0 2 0l7 -4.008c.619 -.355 1 -1.01 1 -1.718z" />
                <path d="M12 22v-10" />
                <path d="M12 12l8.73 -5.04" />
                <path d="M3.27 6.96l8.73 5.04" />
            </svg>
        </span>
        <span class="nav-link-title"> Master Data </span>
    </a>

    <div class="dropdown-menu">
        <a class="dropdown-item" href="#"> Manage Roles </a>
        <a class="dropdown-item" href="#"> Manage Permissions </a>
        <a class="dropdown-item {{ Route::is('user.*') ? 'active' : '' }}" href="{{ route('user.index') }}"> Manage Users </a>
        <a class="dropdown-item {{ Route::is('client.*') ? 'active' : '' }}" href="{{ route('client.index') }}"> Manage Clients </a>
        <a class="dropdown-item {{ Route::is('token.*') ? 'active' : '' }}" href="{{ route('token.index') }}"> Manage Tokens </a>
    </div>
</li>

<li class="nav-item dropdown {{ Route::is('ref-office.*', 'ref-account.*') ? 'active' : '' }}">
    <a class="nav-link dropdown-toggle" href="#navbar-sample" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-folder-symlink">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 21v-4a3 3 0 0 1 3 -3h5" />
                <path d="M8 17l3 -3l-3 -3" />
                <path d="M3 11v-5a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8" />
            </svg>
        </span>
        <span class="nav-link-title"> Reference </span>
    </a>

    <div class="dropdown-menu">
        <a class="dropdown-item {{ Route::is('ref-office.*') ? 'active' : '' }}" href="{{ route('ref-office.index') }}"> Ref Offices </a>
        <a class="dropdown-item {{ Route::is('ref-account.*') ? 'active' : '' }}" href="{{ route('ref-account.index') }}"> Ref Accounts </a>
    </div>
</li>