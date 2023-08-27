@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css">
@endpush

@section('contant')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row header-container">
        <h4 style="margin: 0" class="fw-bold  w-auto"><span class="text-muted fw-light"> <a href="/admin" class="text-secondary">{{ __('admin/dashboard.dashboard') }}</a> / {{ __('admin/setting.setting')}} / </span> {{ __('admin/setting.update_title') }} (v {{ env('APP_VERSION') }})</h4>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="row">
                <div class="col-12 col-md-6 h-100 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/settings/update-app/basic" method="post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="mb-3">{{ __('admin/setting.update_basic_label')}}</label>

                                    <div class="input-group">
                                        <input type="file" name="file" class="form-control js-ajax-file cursor-pointer" id="basicZip">
                                        <div class="invalid-feedback custom-inv-fck"></div>
                                    </div>

                                    <p class="text-muted mt-3">{{ __('admin/setting.update_basic_hint')}}</p>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="basic_update_confirm" class="js-ajax-basic_update_confirm form-check-input" tabindex="3" id="basicUpdateConfirm">
                                        <label class="form-check-label" for="basicUpdateConfirm">{{ __('admin/setting.update_declaration') }}</label>
                                        <div class="invalid-feedback custom-inv-fck"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="progress d-none">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>

                                <button type="button" class="js-update-btn btn btn-primary">{{ __('admin/setting.update') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 h-100 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/settings/update-app/custom-update" method="post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="mb-3">{{ __('admin/setting.update_custom') }}</label>

                                    <div class="input-group">
                                        <input type="file" name="file" class="js-ajax-file form-control cursor-pointer" id="basicZip">
                                    </div>

                                    <p class="text-muted mt-3">{{ __('admin/setting.update_custom_hint') }}</p>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="custom_update_confirm" class="js-ajax-custom_update_confirm form-check-input" tabindex="3" id="customUpdateConfirm">
                                        <label class="form-check-label" for="customUpdateConfirm">{{ __('admin/setting.update_declaration') }}</label>
                                        <div class="invalid-feedback custom-inv-fck"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="progress d-none">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>

                                <button type="button" class="js-update-btn btn btn-primary">{{ __('admin/setting.update_start') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/settings/update-app/database" method="get">
                                {{ csrf_field() }}

                                <p class="text-muted font-12 mb-3">{{ __('admin/setting.update_database_hint')}}</p>

                                <div class="js-database-update-message my-25 text-success"></div>


                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="database_update_confirm" class="js-ajax-database_update_confirm form-check-input" tabindex="3" id="databaseUpdateConfirm">
                                        <label class="form-check-label" for="databaseUpdateConfirm">{{ __('admin/setting.update_declaration') }}</label>
                                        <div class="invalid-feedback custom-inv-fck"></div>
                                    </div>
                                </div>


                                <button type="button" class="js-database-update-btn btn btn-primary">{{ __('admin/setting.update_run') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="section-title ml-0 mt-0 mb-3"><h4>{{ __('admin/setting.hints') }}</h4></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="media-body">
                            <div class="text-primary mt-0 mb-1 font-weight-bold">{{ __('admin/setting.hint_database_title' )}}</div>
                            <div class=" text-small font-600-bold mb-2">{{ __('admin/setting.hint_database_description' )}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts_bottom')
    <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="/assets/admin/js/settings/update_app.min.js"></script>
@endpush
