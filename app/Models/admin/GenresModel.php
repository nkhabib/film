<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class GenresModel extends Model
{
    protected $table            = 'genres';
    protected $allowedFields    = ['name'];
    protected $useTimestamps = true;
}
