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

    <div id="renderAddUserModal"></div>

    <div class="row header-container">
        <h4 style="margin: 0" class="fw-bold  w-auto"><span class="text-muted fw-light"> <a href="/admin" class="text-secondary">Dashboard</a> / </span> Users</h4>
        <a id="addUserBtn" href="javascript:void(0);" type="button" class="btn btn-primary ad-rgr-btn ml-auto addUserBtn">New Users</a>
    </div>
    <div class="card">
        <h5 class="card-header">All Users</h5>
        <div class="table-responsive rgrtable text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th class="col-1">User ID</th>
                        <th>User</th>
                        <th>Last Seen</th>
                        <th>Role</th>
                        <th class="text-center">Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                    <tr>
                        <td row-name="Id" class="col-1">{{$user->id}}</td>
                        <td row-name="User" class="text-left">
                            <div class="d-flex align-items-center">
                                <figure class="t-avatar avatar @if (Cache::has('user-is-online-'.$user->id)) avatar-online @elseif($user->last_seen_enabled) avatar-offline @endif mr-2">
                                    <a href="/admin/users/profile/{{$user->id}}">
                                        <img src="{{$user->avatar ?? '/assets/admin/img/avatars/5.png'}}" alt="Avatar " class="rounded-circle" />
                                    </a>
                                </figure>
                                <div class="media-body ml-1">
                                    <div class="p-0 font-weight-bold"><a href="/admin/users/profile/{{$user->id}}" class="text-secondary">{{$user->name}}</a></div>
                                    <a href="/admin/users/profile/{{$user->id}}" class="d-flex font-600-bold"><small>{{$user->username}}</small></a>
                                    <a href="mailto:{{$user->email}}" class="d-flex font-600-bold"><small>{{$user->email}}</small></a>
                                </div>
                            </div>
                        </td>
                        <td row-name="Last Seen">
                            @if (Cache::has('user-is-online-'.$user->id))
                                <span class="text-success">Online</span>
                            @elseif($user->last_seen_enabled)
                                @if (($user->last_seen ? 1 : 0))
                                    <span class="text-warning">{{\Carbon\Carbon::parse($user->last_seen)->diffForHumans()}}</span>
                                @else
                                    <span>Not Set</span>
                                @endif
                            @else
                                <span class="text-danger">Status Disabled</span>
                            @endif
                        </td>
                        <td row-name="Role">
                            <span>{{$user->role->caption}}</span>
                        </td>
                        <td row-name="Status" class="text-center">
                            <div>
                                @if ($user->status === 'active')
                                    <span class="badge bg-label-success me-1">{{$user->status}}</span>
                                @elseif($user->status === 'pending')
                                    <span class="badge bg-label-warning me-1">{{$user->status}}</span>
                                @else
                                    <span class="badge bg-label-danger me-1">{{$user->status}}</span>
                                @endif
                                @if($user->attendance_enabled)
                                    @if (!empty($user->attendance->attendance))
                                        @if ($user->attendance->attendance === 'p')
                                            <span class="badge bg-label-success">Present</span>
                                        @elseif ($user->attendance->attendance === 'h')
                                            <span class="badge bg-label-warning">Half Day</span>
                                        @elseif ($user->attendance->attendance === 'a')
                                            <span class="badge bg-label-danger">Absent</span>
                                        @endif
                                    @else
                                        <span class="badge bg-label-secondary">Unknown</span>
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td row-name="Action">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a user-id="{{ $user->id }}" href="javascript:void(0);" class="dropdown-item editUserBtn">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>

                                    @can('admin_users_delete_user')
                                        @include('admin.includes.delete_button',['url' => '/' . getAdminUrl() . '/users/' . $user->id . '/delete', 'btn_type' => 'dropdown'])
                                    @endcan
                                </div>
                                @if (!$user->role->is_admin)
                                    <a href="/admin/users/{{$user->id}}/impersonate" target="_blanck" class="me-1 text-info" data-toggle="tooltip" data-placement="top" title="Login ">
                                        <i class="bx bxs-user"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="container">
                <div class="d-flex justify-content-center">
                    {!! $users->onEachSide(1)->links() !!}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts_bottom')
<script>
    $(document).ready(function() {
        $('.addUserBtn').click(function (){
            returnModel('.addUserBtn', '{{url("/" . getAdminUrl() . "/users/create")}}', 'get', '#renderAddUserModal', function(){
                $('#addUserForm').attr('data-url', '/{{ getAdminUrl() }}/users/store');
                $('#addUserModal').modal('show');
            });
        });

        $('.editUserBtn').click(function (){
            $('.addUserBtn').addClass('button__loader');
            returnModel('.editUserBtn', '{{url("/" . getAdminUrl() . "/users/edit")}}' + '/' + $(this).attr('user-id'), 'get', '#renderAddUserModal', function(){
                $('#addUserForm').attr('data-url', '/{{ getAdminUrl() }}/users/update');
                $('#addUserModal').modal('show');
                $('.addUserBtn').removeClass('button__loader');
            });
        });
    });
</script>
@endpush
