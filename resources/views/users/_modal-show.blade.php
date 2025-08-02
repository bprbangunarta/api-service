<!-- Modal Delete -->
<div class="modal modal-blur fade" id="modal-delete-user" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CONFIRMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('user.destroy', Crypt::encryptString($data['user']->id)) }}" id="form-delete-user">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <small class="form-hint text-justify">
                        Before deleting this account, you must download any data or information related to this account that you want to keep.
                    </small>

                    <div class="row g-2 mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="mb-2">
                                <label class="form-label mb-1">Current Password</label>
                                <input type="password" class="form-control" name="delete_user" required />

                                @error('delete_user')
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

                    <button type="submit" class="btn btn-danger btn-2 ms-auto" id="btn-delete-user">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash me-1">
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

<!-- Modal Restore -->
<div class="modal modal-blur fade" id="modal-restore-user" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CONFIRMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('user.restore', Crypt::encryptString($data['user']->id)) }}" id="form-restore-user">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <small class="form-hint text-justify">
                        This account will be restored to active status. Please ensure all settings and permissions have been reviewed before proceeding with the recovery process.
                    </small>

                    <div class="row g-2 mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="mb-2">
                                <label class="form-label mb-1">Current Password</label>
                                <input type="password" class="form-control" name="restore_user" required />

                                @error('restore_user')
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

                    <button type="submit" class="btn btn-success btn-2 ms-auto" id="btn-restore-user">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-restore me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3.06 13a9 9 0 1 0 .49 -4.087" />
                            <path d="M3 4.001v5h5" />
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        </svg>
                        Restore
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>