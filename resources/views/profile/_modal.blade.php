<!-- Modal Hapus Akun -->
<div class="modal modal-blur fade" id="modal-delete-account" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CONFIRMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('profile.delete-account') }}" id="form-delete-account">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <small class="form-hint text-justify">
                        Before deleting this account, you must download any data or information related to this account that you wish to keep.
                    </small>

                    <div class="row g-2 mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="mb-2">
                                <label class="form-label mb-1">Current Password</label>
                                <input type="password" class="form-control" name="delete_account" required />

                                @error('delete_account')
                                <span class="form-check-description text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-danger btn-2 ms-auto" id="btn-delete-account">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 7l16 0" />
                            <path d="M10 11l0 6" />
                            <path d="M14 11l0 6" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sesi Browser -->
<div class="modal modal-blur fade" id="modal-browser-session" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CONFIRMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('profile.logout-session') }}" id="form-browser-session">
                @csrf

                <div class="modal-body">
                    <small class="form-hint text-justify">
                        You can log out of all other browser sessions on all your devices. If you feel your account has been compromised, you should also update your password.
                    </small>

                    <div class="row g-2 mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="mb-2">
                                <label class="form-label mb-1">Current Password</label>
                                <input type="password" class="form-control" name="browser_session" required />

                                @error('browser_session')
                                <span class="form-check-description text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary btn-2 ms-auto" id="btn-browser-session">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                            <path d="M15 12h-12l3 -3" />
                            <path d="M6 15l-3 -3" />
                        </svg>
                        Take it out
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>