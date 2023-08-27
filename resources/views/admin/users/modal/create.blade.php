<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog p-s-20 m-s-0 modal-dialog-centered modal-simple">
        <div class="modal-content p-3">
            <div class="modal-body">
                <button style="top: 0; right: 0;" type="button" class="btn-close btn-pinned"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class=" mb-4">
                    <h3>@if(!empty($user)) Edit @else Create New @endif User</h3>
                </div>
                <div class="mb-4">
                    @if ($errors->any() and empty(old('user_id')))
                        <div class="alert error alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="addUserForm" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="/assets/admin/img/avatars/1.png" alt="user-avatar" class="d-block rounded"
                                height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" name="avatar"
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

                        <div class="row">
                            <button type="submit" class="btn btn-primary mb-2">@if(!empty($user)) Update @else Save @endif User</button>
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Discard </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
