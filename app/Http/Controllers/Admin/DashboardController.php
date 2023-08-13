<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $this->authorize('admin_general_dashboard_show');

        $data = [
            'pageTitle' => 'Dashboard',
        ];
        
        return view('admin.dashboard',$data);
    }
}
