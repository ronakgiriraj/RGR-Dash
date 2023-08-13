@extends('admin.layouts.app')
@push('styles_top')
@endpush
@section('contant')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row header-container">
        <h4 style="margin: 0" class="fw-bold  w-auto"><span class="text-muted fw-light"> <a href="/admin" class="text-secondary">Dashboard</a> / </span> Settings</h4>
        {{-- <button type="button" class="btn btn-primary ad-rgr-btn ml-auto addPermissionBtn">New Permissions</button> --}}
    </div>

    <section class="section">
        <div class="section-body">
            <h2 class="section-title">Control Everything</h2>
            <p class="section-lead">
                You can change all of the parameters and variables using the following cards.
            </p>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card overflow-hidden">
                        <div class="row">
                            <div style="min-height: 120px;" class="col-md-4">
                                <div class="w-100 h-100 d-flex justify-content-center align-items-center bg-primary text-white">
                                    <i class="bx bx-cloud-upload display-1"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4>Update Your Web Application</h4>
                                    <a href="/admin/settings/update-app" class="card-cta text-primary">Update<i class="bx bx-arrow-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

