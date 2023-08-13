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

    <div class="" id="renderAddPermissionModal"></div>

    <div class="row header-container">
        <h4 style="margin: 0" class="fw-bold  w-auto"><span class="text-muted fw-light"> <a href="/admin" class="text-secondary">Dashboard</a> / </span> Role @if(!empty($role)) Edit @else Create  @endif </h4>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="/{{ getAdminUrl() }}/roles/{{ !empty($role) ? $role->id.'/update' : 'store' }}" method="Post">
                @csrf

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            @if(empty($role))
                                <div class="col-12 col-md-6 col-lg-6 mb-3">
                                    <div class="form-group @error('name') is-invalid @enderror">
                                        <label>Role Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder=""/>

                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <div class="form-group @error('caption') is-invalid @enderror">
                                    <label>Role Caption</label>
                                    <input type="text" name="caption" class="form-control" value="{{ !empty($role) ? $role->caption : old('caption') }}" placeholder="Eg. Staf, Manager .."/>

                                    @error('caption')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if(empty($role) or !$role->isDefaultRole())
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-1">
                                        <label class="custom-switch pl-0">
                                            <input id="isAdmin" type="checkbox" name="is_admin" class="section-parent form-check-input" {{ (!empty($role) && $role->is_admin) ? 'checked' : '' }}>
                                            <label for="isAdmin" class="cursor-pointer">Admin Panel Access</label>
                                        </label>
                                    </div>
                                    <div class="text-muted text-small mt-1">Turn it on for creating admins or staff.</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group {{ (!empty($role) && $role->is_admin) ? '' :'d-none'}}" id="sections">
                    <div class="row">
                        @foreach($sections as $section)
                            @if($loop->index !== 0)
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <div class="card card-primary section-box">
                                        <div class="card-header">
                                            <input type="checkbox" name="permissions[]" id="permissions_{{ $section->id }}" value="{{ $section->id }}"
                                                {{isset($permissions[$section->id]) ? 'checked' : ''}} class="form-check-input mt-0 section-parent">
                                            <label class="form-check-label font-16 font-weight-bold cursor-pointer" for="permissions_{{ $section->id }}">
                                                {{ $section->caption }}
                                            </label>
                                        </div>

                                        @if(!empty($section->children))
                                            <div class="card-body">

                                                @foreach($section->children as $key => $child)
                                                    <div class="form-check mt-1">
                                                        <input type="checkbox" name="permissions[]" id="permissions_{{ $child->id }}" value="{{ $child->id }}"
                                                            {{ isset($permissions[$child->id]) ? 'checked' : '' }} class="form-check-input section-child">
                                                        <label class="form-check-label cursor-pointer mt-0" for="permissions_{{ $child->id }}">
                                                            {{ $child->caption }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class=" mt-4">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles_bottom')
@endpush
@push('scripts_bottom')
    <script>
        (function ($) {
            "use strict";

            $('body').on('change', '#isAdmin', function () {
                if (this.checked) {
                $('#sections').removeClass('d-none');
                } else {
                $('#sections').addClass('d-none');
                }
            });
            $('.section-parent').on('change', function (e) {
                var $this = $(this);
                var parent = $this.parent().closest('.section-box');
                var isChecked = e.target.checked;

                if (isChecked) {
                parent.find('input[type="checkbox"].section-child').prop('checked', true);
                } else {
                parent.find('input[type="checkbox"].section-child').prop('checked', false);
                }
            });
            $('.section-child').on('change', function (e) {
                var $this = $(this);
                var parent = $(this).parent().closest('.section-box');
                var setChecked = false;
                var allChild = parent.find('input[type="checkbox"].section-child');
                allChild.each(function (index, child) {
                if ($(child).is(':checked')) {
                    setChecked = true;
                }
                });
                var parentInput = parent.find('input[type="checkbox"].section-parent');
                parentInput.prop('checked', setChecked);
            });
            })(jQuery);

    </script>
@endpush
