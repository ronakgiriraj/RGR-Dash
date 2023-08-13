@extends('admin.layouts.app')
@push('styles_top')
    <link rel="stylesheet" href="/assets/vendor/libs/animate-css/animate.css">
    <link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css">
@endpush
@section('contant')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- @include('admin.roles_permissions.modals.delete_permission') --}}
    <div class="" id="renderAddPermissionModal"></div>
    <div class="row header-container">
        <h4 style="margin: 0" class="fw-bold  w-auto"><span class="text-muted fw-light"> <a href="/admin" class="text-secondary">Dashboard</a> / </span> Permissions</h4>
        <a id="addPermissionBtn" href="javascript:void(0);" type="button" class="btn btn-primary ad-rgr-btn ml-auto addPermissionBtn">New Permissions</a>
    </div>
    <div class="card">
        <h5 class="card-header deletepermissionBtn">All permissions</h5>
        <div class="table-responsive rgrtable text-nowrap min-h350">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Caption</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($permissions as $permission)
                        @if ($permission->id !== 1)
                            <tr>
                                <td row-name="Id">{{$permission->id}}</td>
                                <td row-name="Caption">{{$permission->caption}}</td>
                                <td row-name="Name">{{$permission->name}}</td>
                                <td row-name="Actions">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a permission-caption="{{$permission->caption}}" permission-id="{{ $permission->id }}" style="cursor: pointer" class="dropdown-item editPermissionBtn"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a permission-id="{{ $permission->id }}" style="cursor: pointer" class="dropdown-item deletePermissionBtn"><i class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    <tr></tr>
                </tbody>
            </table>
        </div>
        <div class="container">
            <div class="d-flex pt-3 justify-content-center">
                {!! $permissions->onEachSide(1)->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles_bottom')
@endpush
@push('scripts_bottom')
    <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script>
        $(document).ready(function() {
            $('.addPermissionBtn').click(function (){
                returnModel('.addPermissionBtn', '{{url("/" . getAdminUrl() . "/permissions/create")}}', 'get', '#renderAddPermissionModal', function(){
                    $('#addPermissionForm').attr('data-url', '/{{ getAdminUrl() }}/permissions/store');
                    $('#addPermissionModal').modal('show');
                });
            });

            $('.editPermissionBtn').click(function (){
                $('.addPermissionBtn').addClass('button__loader');
                returnModel('.editPermissionBtn', '{{url("/" . getAdminUrl() . "/permissions/edit")}}' + '/' + $(this).attr('permission-id'), 'get', '#renderAddPermissionModal', function(){
                    $('#addPermissionForm').attr('data-url', '/{{ getAdminUrl() }}/permissions/update');
                    $('#addPermissionModal').modal('show');
                    $('.addPermissionBtn').removeClass('button__loader');
                });
            });
        });
    </script>
@endpush


