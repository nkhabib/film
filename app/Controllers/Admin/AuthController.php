<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function dashboard()
    {
        // $this->userAcceess->addPermission('admin.access', 'admin.access');
        // dd($this->userAcceess->getPermissions());
        // if ($this->userAcceess->can('user.create')) {
        //     echo "mbuh intine iso";
        // } else {
        //     echo "ora iso";
        // }
        // die();
        $data = [
            'title' => 'Admin Dashboard',
        ];
        return view('admin/dashboard', $data);
    }
}
