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
        <h4 style="margin: 0" class="fw-bold  w-auto"><span class="text-muted fw-light"> <a href="/admin" class="text-secondary">Dashboard</a> / </span> Roles</h4>
        <a href="/{{ getAdminUrl() }}/roles/create" type="button" class="btn btn-primary ad-rgr-btn ml-auto addPermissionBtn">New Role</a>
    </div>
    
    <div class="card">
        <h5 class="card-header deletepermissionBtn">All Roles</h5>
        <div class="table-responsive rgrtable text-nowrap min-h350">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Users</th>
                        <th>Is Admin</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($roles as $role)
                        <tr>
                            <td row-name="Id">{{$role->id}}</td>
                            <td row-name="Name" class="text-left">{{$role->name}}</td>
                            <td row-name="Users">{{$role->users->count()}}</td>
                            <td row-name="Is Admin">
                                @if($role->is_admin)
                                    <i class="text-success bx bx-check"></i>
                                @else
                                    <i class="text-danger bx bx-x"></i>
                                @endif
                            </td>
                            <td row-name="Created At">{{ $role->created_at }}</td>
                            <td row-name="Action">
                                @can('admin_role_permissions_edit_role')
                                    <a href="/{{ getAdminUrl() }}/roles/{{ $role->id }}/edit" class="btn-transparent text-primary">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                @endcan
                                @if($role->canDelete())
                                    @can('admin_role_permissions_delete_role')
                                        @include('admin.includes.delete_button',['url' => '/' . getAdminUrl() . '/roles/' . $role->id . '/delete'])
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr></tr>
                </tbody>
            </table>
        </div>
        <div class="container">
            <div class="d-flex pt-3 justify-content-center">
                {!! $roles->onEachSide(1)->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles_bottom')
@endpush
@push('scripts_bottom')
@endpush
