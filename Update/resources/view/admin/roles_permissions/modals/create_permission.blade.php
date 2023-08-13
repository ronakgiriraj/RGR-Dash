
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content p-3">
            <div class="modal-body">
                <button type="button" style="top: 0; right: 0;" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="text-center mb-4">
                    <h3 class="text-primary">{{ $modalTitle }}</h3>
                    <p>{{ $modelSub ?? ''}}</p>
                </div>

                @if(!empty($warning))
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-2">Warning</h6>
                        <p class="mb-0">{{ $warning }}</p>
                    </div>
                @endif

                <form id="addPermissionForm" class="row">
                    @csrf

                    @if(!empty($permission->id))
                        <input type="hidden" name="id" value="{{ $permission->id }}">
                    @endif

                    <div class="col-12 mb-3">
                        <label class="form-label" for="modalPermissionName">Permission Caption</label>
                        <input type="text" name="caption" class="form-control"
                            placeholder="Permission Caption" value="{{ $permission->caption ?? ''}}" autofocus />
                    </div>

                    @if(!empty($permission->name))
                        <input type="hidden" name="name">
                    @endif

                    @if(!empty($groupList))
                        <div class="mb-3 col-12">
                            <label class="form-label" for="group_id">Group</label>
                            <select id="group_id" name="group_id" class="select2 form-select">
                                <option selected disabled>Select</option>
                                @foreach ($groupList as $group)
                                    {{ renderOptions('group_id', '', $group->id, $group->caption)}}
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="col-12 text-center demo-vertical-spacing">
                        <button id="addPermissionFormSubmit" type="submit" class="btn btn-primary me-sm-3 me-1">{{ $submitBtn }}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Discard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        makeFormSubmit('#addPermissionForm', '#addPermissionFormSubmit', '{{ $formUrl }}', function(result){
            $('#addPermissionModal').modal('hide');
            console.log(result);
        });
    });

</script>
