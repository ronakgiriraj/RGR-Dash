<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $this->authorize('admin_users_list');

        $user = auth()->user();

        $users = User::with('role')
            ->paginate(10);

        $data = [
            'pageTitle' => 'Users',
            'users' => $users,
        ];
        return view('admin.users.index',$data);
    }

    public function create(){
        $this->authorize('admin_users_create_new_user');
        if(!empty($id)){
            $user = User::findOrFail($id);
        }

        $roles = Roles::get();

        $data = [
            'roles' => $roles,
            'user' => $user ?? null,
            'modalTitle' => 'Create New User',
            'submitBtn' => 'Save User',
            'formUrl' => '/' . getAdminUrl() . '/users/store',
        ];
        return view('admin.users.modal.create',$data);
    }

    public function edit($id){
        $this->authorize('admin_users_edit_user');
        if(!empty($id)){
            $user = User::findOrFail($id);
        }

        $roles = Roles::get();

        $data = [
            'roles' => $roles,
            'user' => $user,
            'modalTitle' => 'Edit User',
            'submitBtn' => 'Update User',
            'formUrl' => '/' . getAdminUrl() . '/users/update',
        ];
        return view('admin.users.modal.create',$data);
    }

    public function store(Request $request){
        $this->authorize('admin_users_create_new_user');

        $validate = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required','string','regex:/^\S*$/u','max:255','unique:users,username',],
            'mobile' => 'max:11|unique:users,mobile',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:20|min:6',
            'bio' => 'max:500',
            'role_id' => 'required|exists:roles,id',
            'avatar' => 'file|max:2024'
        ]);

        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'bio' => $request['bio'],
            'password' => Hash::make($request['password']),
            'role_id' => $request['role_id'],
            'attendance_enabled' => ($request['attendance_enabled'] ?? '') == 'on' ? '1' : '0',
        ]);

        if(empty($request['avatar'])){
            $user->avatar = '/assets/admin/img/avatars/default-avatar.png';
            $user->save();
        }else{
            $user->avatar = createFile($request, 'avatar', $user->id.  '/avatar', 'avatar');
            $user->save();
        }

        $data = [
            'msg' => 'New User Created Successfully'
        ];

        return $data;
    }

    public function update(Request $request){
        $this->authorize('admin_users_edit_user');

        $user = User::findOrFail($request['id']);

        if ($user->name !== $request['name']){
            $request->validate([
                'name' => ['required','max:255',],
            ]);
        }

        if ($user->username !== $request['username']){
            $request->validate([
                'username' => ['required','string','regex:/^\S*$/u','max:255','unique:users,username',],
            ]);
        }

        if ($user->mobile !== $request['mobile']){
            $request->validate([
                'mobile' => 'max:11|numeric|unique:users,mobile',
            ]);
        }

        if ($user->email !== $request['email']){
            $request->validate([
                'email' => 'required|max:255|unique:users,email',
            ]);
        }

        if ($user->bio !== $request['bio']){
            $request->validate([
                'bio' => 'max:255',
            ]);
        }

        if ($user->role_id !== $request['role_id']){
            $request->validate([
                'role_id' => 'required|exists:roles,id'
            ]);
        }

        if(!empty($request['avatar'])){
            $request->validate([
                'avatar' => 'required|file|max:2024'
            ]);

            $avatar = createFile($request, 'avatar', $user->id.  '/avatar', 'avatar');
        }

        $user->update([
            'name' => $request['name'],
            'username' => $request['username'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'bio' => $request['bio'],
            'password' => Hash::make($request['password']),
            'role_id' => $request['role_id'] ?? $user->role_id,
            'avatar' => !empty($request['avatar']) ? $avatar : $user->avatar,
        ]);

        $data = [
            'msg' => 'User Updated Successfully'
        ];

        return $data;
    }

    public function profile(){
        return $this->view(auth()->user()->id, 'account');
    }

    public function view($user_id, $view = 'account'){
        $user = User::find($user_id);

        $data = [
            'pageTitle' => 'Subscriber Create',
            'view' => $view,
            'user' => $user,
        ];

        return view('admin.users.profile',$data);
    }

    public function delete($id){
        User::findorFail($id)->delete();

        return redirect('/admin/users')->with('success', 'User Deleted Successfully');
    }

    public function impersonate($user_id)
    {
        $user = User::findOrFail($user_id);

        session()->put(['impersonated' => $user->id]);

        if ($user->isAdmin()) {
            return redirect('/admin');
        }else{
            return redirect('/panel');
        }
    }
}
