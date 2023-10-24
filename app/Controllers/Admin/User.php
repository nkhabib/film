<?php

namespace App\Controllers\Admin;
// kode diatas untuk menandakan kalo controller ini didalam folder admin dan juga agar dikenali
// dalam routes sebagai sebuah controller

use App\Controllers\BaseController;
use App\Models\admin\UsersModel;

class User extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UsersModel();
    }
    // object oriented programming
    // protected $userModel dan $this->userModel = new UserModel();
    // digunakan agar model bisa digunakan di function atau kelas manapun didalam controller User
    public function index()
    {
        $user = $this->userModel->findAll();
        dd($user);
        $data = [
            'title' => 'User'
        ];
        dd($data);
    }
}
