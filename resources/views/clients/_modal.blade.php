<!-- Modal Delete -->
<div class="modal modal-blur fade" id="modal-delete-client" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CONFIRMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('client.destroy', Crypt::encryptString($data['client']->id)) }}" id="form-delete-client">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <small class="form-hint text-justify">
                        Before deleting this client, please download any data or information related to this client that you wish to keep.
                    </small>

                    <div class="row g-2 mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="mb-2">
                                <label class="form-label mb-1">Current Password</label>
                                <input type="password" class="form-control" name="delete_client" required />

                                @error('delete_client')
                                <span class="form-check-description text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal">
                        Camcel
                    </a>

                    <button type="submit" class="btn btn-danger btn-2 ms-auto" id="btn-delete-client">
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
<div class="modal modal-blur fade" id="modal-restore-client" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CONFIRMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('client.restore', Crypt::encryptString($data['client']->id)) }}" id="form-restore-client">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <small class="form-hint text-justify">
                        This client will be restored to an active state. Please ensure all settings and permissions have been reviewed before proceeding with the recovery process.
                    </small>

                    <div class="row g-2 mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="mb-2">
                                <label class="form-label mb-1">Current Password</label>
                                <input type="password" class="form-control" name="restore_client" required />

                                @error('restore_client')
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

                    <button type="submit" class="btn btn-success btn-2 ms-auto" id="btn-restore-client">
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

<!-- Modal Logs -->
<div class="modal modal-blur fade" id="modal-log" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">LOG DETAIL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- card-body content -->
            </div>

            <div class="modal-footer">
                <a class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal">
                    Close
                </a>
            </div>
        </div>
    </div>
</div>