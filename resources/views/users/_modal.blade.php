<!-- Modal Add User -->
<div class="modal modal-blur fade" id="modal-add" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-primary"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon mb-2 text-primary icon-lg icon-tabler icons-tabler-outline icon-tabler-user">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                </svg>
                <h3>Add User</h3>
                <div class="text-secondary">
                    You can add data directly or by importing data via Excel using a template.
                </div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn btn-2 w-100" data-bs-toggle="modal" data-bs-target="#modal-import"> Import </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('user.create') }}" class="btn btn-2 w-100"> Create </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import User -->
<div class="modal modal-blur fade" id="modal-import" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-primary"></div>
            <form method="POST" action="{{ route('import.users') }}" id="form-import-user" enctype="multipart/form-data">
                @csrf

                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon mb-2 text-primary icon-lg icon-tabler icons-tabler-outline icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    <h3>Add User</h3>
                    <div class="text-secondary">
                        Before importing, make sure all the data entered is in accordance with the specified <a href="{{ asset('excel/users.xlsx') }}"><strong>Excel format</strong></a>.
                    </div>

                    <div class="row g-2 mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="mb-2">
                                <input type="file" class="form-control" name="file" accept=".xlsx" required />

                                @error('file')
                                <span class="form-check-description text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-link link-secondary btn-3" data-bs-toggle="modal" data-bs-target="#modal-add">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-2 btn-2 ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-table-import me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 21h-7a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8" />
                            <path d="M3 10h18" />
                            <path d="M10 3v18" />
                            <path d="M19 22v-6" />
                            <path d="M22 19l-3 -3l-3 3" />
                        </svg>
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>