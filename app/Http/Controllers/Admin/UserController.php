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

    public function create($id = null){
        $this->authorize('admin_users_create_new_user');
        if(!empty($id)){
            $user = User::findOrFail($id);
        }

        $roles = Roles::get();

        $data = [
            'roles' => $roles,
            'user' => $user ?? null,
        ];
        return view('admin.users.modal.create',$data);
    }

    public function edit($id){
        $this->authorize('admin_users_edit_user');
        return $this->create($id);
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
            'role_id' => 'required',
        ]);

        $reqData = $request->all();

        $channelPartnerId = auth()->guard('web')->user()->channel_partner_id;
        $reqData['channel_partner_id'] = $channelPartnerId;
        $reqData['password'] = Hash::make($reqData['password']);
        $reqData['status'] = 'active';
        $reqData['verified'] = '1';
        $reqData['attendance_enabled'] = ($reqData['attendance_enabled'] ?? '') == 'on' ? '1' : '0';

        // p_d($request->all());

        $user = User::create($reqData);

        if(empty($reqData['avatar'])){
            $user->avatar = '/assets/admin/img/avatars/default-avatar.png';
            $user->save();
        }else{
            $user->avatar = $this->createImage($request, $user, 'avatar');
            $user->save();
        }

        return redirect('/admin/users')->with('success', 'New User Created Successfully');
    }

    public function profile(){
        return $this->view(auth()->guard('web')->user()->id, 'account');
    }

    public function view($user_id, $view = 'account'){
        $user = User::find($user_id);
        // $subscriberKyc = SubscriberKyc::find($subscriber->kyc_id);

        // if ($view === 'installation'){
        //     $InstallationInformation = InstallationInformation::find($subscriber->installation_information_id);
        // }

        $data = [
            'pageTitle' => 'Subscriber Create',
            'view' => $view,
            'user' => $user,
            // 'subscriberKyc' => $subscriberKyc ?? '',
            // 'installationInformation' => $InstallationInformation ?? '',
        ];
        return view('admin.users.profile',$data);
    }

    public function createImage($request, $user, $img)
    {
        $folderPath = "UId" . $user->id . "/avatar";

        $file = uniqid() . '.' . $request->file($img)->getClientOriginalExtension();

        return '/store/'.$request->file($img)->storeAs($folderPath, $file);
    }

    public function update(Request $request){
        $validate = $request->validate([
            'n_name' => 'required|max:255',
            'n_bio' => 'max:500',
        ]);
        // p_d($request->all());

        $user = User::find($request['user_id']);

        // p_d($user->username);
        if ($user->username !== $request['n_username']){
            $validate = $request->validate([
                'n_username' => ['required','string','regex:/^\S*$/u','max:255','unique:users,username',],
            ]);
        }
        if ($user->mobile !== $request['n_mobile']){
            $validate = $request->validate([
                'n_mobile' => 'max:11|numeric|unique:users,mobile',
            ]);
        }
        if ($user->email !== $request['n_email']){
            $validate = $request->validate([
                'n_email' => 'required|max:255|unique:users,email',
            ]);
        }

        if(!empty($request['n_avatar'])){
            $avatar = $this->createImage($request, $user, 'n_avatar');
        }

        $user->update([
            'name' => $request['n_name'],
            'username' => $request['n_username'],
            'mobile' => $request['n_mobile'],
            'email' => $request['n_email'],
            'bio' => $request['n_bio'],
            'role_id' => $request['n_role_id'] ?? $user->role_id,
            'avatar' => $avatar ?? $user->avatar,
            'attendance_enabled' => ($request['n_attendance_enabled'] ?? '') == 'on' ? '1' : '0',
        ]);

        return back()->with('success', 'User Updated Successfully');
    }

    public function actionByPost(Request $request, $action){
        if($action === 'delete'){
            User::find($request['user_id'])->delete();

            return redirect('/admin/users')->with('success', 'User Deleted Successfully');
        }
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
