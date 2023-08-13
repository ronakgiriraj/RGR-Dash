<div class="modal fade" id="deletePermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content p-3">
            <div class="modal-body">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Delete Permission</h3>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-2">Warning</h6>
                        <p class="mb-0">
                            Are you sure you want to delete this Permission<br>
                        </p>
                    </div>
                    <form action="/{{ getAdminUrl() }}/permissions/delete" method="post">
                        @csrf
                        <div class="col-12 text-center demo-vertical-spacing">
                            <input type="hidden" id="delete_permission_id" name="delete_permission_id" value="">
                            <button type="submit" class="btn btn-danger">I'm sure</button>
                            <button type="reset" class="btn btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Discard</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts_bottom')
    <script>
        $('.deletePermissionBtn').click(function (e) {
            e.preventDefault();

            var permission_id = $(this).attr('permission-id');
            $('#delete_permission_id').val(permission_id);
            $('#deletePermissionModal').modal('show');
        });
    </script>
@endpush

