<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sections;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){
        $this->authorize('admin_role_permissions_permissions_list');
        $permissions = Sections::paginate(10);

        $data = [
            'pageTitle' => 'Permissions',
            'permissions' => $permissions,
        ];
        return view('admin.roles_permissions.permissions',$data);
    }

    public function create(){
        $this->authorize('admin_role_permissions_create_permission');
        $groupList = Sections::where('group_id', '1')->get();

        $data = [
            'modalTitle' => 'Create New Permission',
            'submitBtn' => 'Create Permission',
            'formUrl' => '/' . getAdminUrl() . '/permissions/store',
            'groupList' => $groupList,
        ];

        return view('admin.roles_permissions.modals.create_permission', $data);
    }

    public function store(Request $request){
        $this->authorize('admin_role_permissions_create_permission');

        $validate = $request->validate([
            'caption' => 'required|max:255',
            'group_id' => 'required|max:20',
        ]);

        $group = Sections::find($request['group_id']);
        $request['name'] = $group->name.'_'.Str::slug($request->input('caption'), "_");

        $validate = $request->validate([
            'name' => 'required|max:255|unique:sections,name',
        ]);

        $section = Sections::create([
            'name' => $request['name'],
            'caption' => $request['caption'],
            'group_id' => $request['group_id'],
        ]);

        $data = [
            'msg' => 'New Permission Created'
        ];

        return $data;
    }

    public function edit($id){
        $this->authorize('admin_role_permissions_edit_permission');
        $permission = Sections::find($id);

        $data = [
            'modalTitle' => 'Edit Permission',
            'submitBtn' => 'Update Permission',
            'formUrl' => '/' . getAdminUrl() . '/permissions/update',
            'warning' => "By editing the permission name, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.",
            'permission' => $permission
        ];

        return view('admin.roles_permissions.modals.create_permission', $data);
    }

    public function update(Request $request){
        $this->authorize('admin_role_permissions_edit_permission');

        $validate = $request->validate([
            'caption' => 'required|max:255',
            'id' => 'required|max:20|exists:sections,id',
        ]);

        $section = Sections::find($request['id']);
        $group = Sections::find($section->group_id);
        $request['name'] = $group->name.'_'.Str::slug($request->input('caption'), "_");

        $validate = $request->validate([
            'name' => 'required|max:255|unique:sections,name',
        ]);

        $section->update([
            'name' => $request['name'],
            'caption' => $request['caption'],
        ]);

        $data = [
            'msg' => 'Permission Updated'
        ];

        return $data;
    }

    public function delete(Request $request){
        $this->authorize('admin_role_permissions_delete_permission');

        $validate = $request->validate([
            'delete_permission_id' => 'required|max:20',
        ]);

        $delete = Sections::find($request['delete_permission_id'])->delete();

        return redirect('/' . getAdminUrl() . '/permissions')->with('success', 'Permissions Deleted Successfully');
    }
}
