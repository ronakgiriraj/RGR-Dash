<div style="background: rgba(0,0,0,.2);" class="modal fade show" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content p-3">
            <div class="modal-body">
                <div style="box-shadow: none;" class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    {{-- logo --}}
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">{{ $generalSettings['site_name'] ?? env('APP_NAME') }}</span>
                            </a>
                        </div>


                        <form id="formAuthentication" class="mb-3" action="{{url('/'.getAdminUrl() .'/login')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username Or Email</label>
                                <input type="text" value="{{ old('username') }}" class="form-control @error('username')  is-invalid @enderror" id="username" name="username"
                                    placeholder="Enter your username " autofocus required/>
                                @error('username')
                                <div style="display: block" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a>
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control @error('password')  is-invalid @enderror" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    @error('password')
                                        <div style="display: block" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input @checked(old('remember')) name="remember" class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
