<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Sections;
use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

class RoleController extends Controller
{
    public function index(){
        $this->authorize('admin_role_permissions_roles_list');

        $roles = Roles::with('users')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        $data = [
            'pageTitle' => 'Roles',
            'roles' => $roles,
        ];

        return view('admin.roles_permissions.roles', $data);
    }

    public function create(){
        $this->authorize('admin_role_permissions_create_new_role');

        $sections = Sections::where('group_id', 1)
            ->with('children')
            ->get();

        $data = [
            'pageTitle' => 'Create New Role',
            'sections' => $sections
        ];

        return view('admin.roles_permissions.role_create', $data);
    }

    public function store(Request $request){
        $this->authorize('admin_role_permissions_create_new_role');

        $request->validate([
            'name' => 'required|min:3|max:64|unique:roles,name',
            'caption' => 'required|min:3|max:64|unique:roles,caption',
        ]);

        $role = Roles::create([
            'name' => $request['name'],
            'caption' => $request['caption'],
            'is_admin' => (!empty($request['is_admin']) and $request['is_admin'] == 'on') ? '1' : '0',
            'created_at' => time(),
        ]);

        if ($role->is_admin and $request->has('permissions')) {
            $this->storePermission($role, $request['permissions']);
        }
        Cache::forget('sections');

        return redirect(getAdminUrl().'/roles');
    }

    public function edit($id){
        $this->authorize('admin_role_permissions_edit_role');

        $role = Roles::findOrFail($id);
        $permissions = Permission::where('role_id', '=', $role->id)->get();
        $sections = Sections::where('group_id', 1)
            ->with('children')
            ->get();

        $data = [
            'pageTitle' => 'Edit Role',
            'role' => $role,
            'sections' => $sections,
            'permissions' => $permissions->keyBy('section_id')
        ];

        return view('admin.roles_permissions.role_create', $data);
    }

    public function update(Request $request, $id){
        $this->authorize('admin_role_permissions_edit_role');

        $role = Roles::find($id);

        $this->validate($request, [
            'caption' => 'required',
        ]);

        $data = $request->all();

        $role->update([
            'caption' => $data['caption'],
            'is_admin' => ((!empty($data['is_admin']) and $data['is_admin'] == 'on') or $role->name == Roles::$admin) ? '1' : '0',
        ]);

        Permission::where('role_id', '=', $role->id)->delete();

        if ($role->is_admin and !empty($data['permissions'])) {
            $this->storePermission($role, $data['permissions']);
        }

        Cache::forget('sections');

        return redirect(getAdminUrl().'/roles');
    }

    public function delete(Request $request, $id){
        $this->authorize('admin_role_permissions_delete_role');

        $role = Roles::findOrFail($id);
        if ($role->id !== 2) {
            $role->delete();
        }

        return redirect(getAdminUrl().'/roles');
    }

    public function storePermission($role, $sections){
        $sectionsId = Sections::whereIn('id', $sections)->pluck('id');
        $permissions = [];
        foreach ($sectionsId as $section_id) {
            $permissions[] = [
                'role_id' => $role->id,
                'section_id' => $section_id,
                'allow' => '1',
            ];
        }
        Permission::insert($permissions);
    }

    public function makeAdminDefaultPermission(){
        $role = Roles::find(1);

        Permission::where('role_id', '=', $role->id)->delete();

        if ($role->is_admin) {
            $sectionsId = Sections::pluck('id');
            $permissions = [];
            foreach ($sectionsId as $section_id) {
                $permissions[] = [
                    'role_id' => $role->id,
                    'section_id' => $section_id,
                    'allow' => '1',
                ];
            }
            Permission::insert($permissions);
        }

        Cache::forget('sections');

        return redirect(getAdminUrl().'/');
    }
}
