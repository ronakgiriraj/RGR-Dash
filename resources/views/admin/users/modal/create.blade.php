<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
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

                <form id="addUserForm" enctype="multipart/form-data">
                    @csrf
                    @if (!empty($user->id))
                        <input type="hidden" name="id" value="{{ $user->id }}">
                    @endif
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ $user->avatar ?? '/assets/admin/img/avatars/1.png' }}" alt="user-avatar" class="d-block rounded"
                            height="100" width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="uploadInput" uploadRender="uploadedAvatar" name="avatar"
                                    hidden accept="image/png, image/jpeg, image/jpg, image/webp" />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>

                    <hr class="my-0" />

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ $user->name ?? '' }}" autofocus/>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" type="text" id="username" name="username" value="{{ $user->username ?? '' }}"/>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ $user->email ?? '' }}" placeholder="ronak.giri@tankaar.in"/>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="mobile">Mobile Number</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">IND
                                    (+91)</span>
                                <input type="text" id="mobile" value="{{ $user->mobile ?? '' }}" name="mobile" class="form-control" placeholder="620 555 0111" />
                            </div>
                        </div>

                        <div class="mb-3 col-md-6 form-password-toggle">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password"
                                    id="password" name="password" value="{{ old('password') }}"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="bio" class="form-label">Bio <small>(optional)</small></label>
                            <input type="text" class="form-control @error('bio') is-invalid @enderror"
                                id="bio" value="{{ $user->bio ?? '' }}" name="bio" placeholder="bio" />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="role_id">Role</label>
                            <select id="role_id" name="role_id"
                                class="select2 form-select">
                                <option @if (empty(old('role'))) selected @endif disabled>Select</option>
                                @foreach ($roles as $role)
                                    {{ renderOptions('role_id', $user->role->id ?? '', $role->id, $role->name) }}
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 text-center demo-vertical-spacing">
                        <button id="addUserFormSubmit" type="submit" class="btn btn-primary me-sm-3 me-1">{{ $submitBtn }}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Discard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        imageRender();

        $(document).ready(function() {
            makeFormSubmit('#addUserForm', '.addUserFormSubmit', '{{ $formUrl }}', function(result){
                $('#addUserModal').modal('hide');
                console.log(result);
            });
        });
    });
</script>
