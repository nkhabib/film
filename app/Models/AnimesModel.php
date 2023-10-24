<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimesModel extends Model
{
    protected $table            = 'animes';
    protected $useTimestamps     = true;
    // $useTimestamps berguna akan isi otomatis pada field created at atau updated at jika nilainya true
    protected $allowedFields    = ['title', 'slug', 'sinopsis', 'id_genre', 'image', 'release_date', 'end_date', 'season'];

    public function get()
    {
        return $this->findAll();
    }
}
