<?php

namespace App\Models\admin;
// namsespace diatas harus berurut sesuai folder

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
}
