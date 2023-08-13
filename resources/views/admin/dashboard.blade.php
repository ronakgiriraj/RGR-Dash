@extends('admin.layouts.app')
@section('contant')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <span>Staff Salary</span>
                                        <div class="d-flex align-items-end mt-2">
                                            <h4 class="mb-0 me-2"> 0 </h4>
                                            <small>(1)</small>
                                        </div>
                                        <small>This Month <small> (Total)</small></small>
                                    </div>

                                    <span class="badge bg-label-primary rounded p-2">
                                        <i class="bx bx-user bx-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <span>Fuel</span>
                                        <div class="d-flex align-items-end mt-2">
                                            <h4 class="mb-0 me-2"> 0 </h4>
                                            <small>(1)</small>
                                        </div>
                                        <small>This Month <small> (Total)</small></small>
                                    </div>

                                    <span class="badge bg-label-warning rounded p-2">
                                        <i class="bx bxs-droplet bx-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="row">
                    <div class="col-md-6 col-12 mb-4 h-100">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <i class="bx display-4 text-success bx-user-circle me-2"></i>
                                <h3 class="m-0">Leads</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p>Total Registration</p>
                                    <p>100</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Total Leads</p>
                                    <p>100</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Total Online Leads</p>
                                    <p>100</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Total Online Request</p>
                                    <p>100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-4 h-100">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <i class="bx display-4 text-primary bx-id-card me-2"></i>
                                <h3 class="m-0">Subscribers</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p>Subscribers</p>
                                    <p>100</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Subscribers with Instalettion Completed</p>
                                    <p>100</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Subscribers with Gis Completed</p>
                                    <p>100</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Subscribers with UC Completed</p>
                                    <p>100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts_bottom')
    <script src="/assets/admin/vendor/libs/apex-charts/apexcharts.js"></script>

    <script src="/assets/admin/js/dashboards-analytics.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
@endpush
