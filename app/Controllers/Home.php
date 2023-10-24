<?php

namespace App\Controllers;

use App\Models\Admin\GenresModel;

class Home extends BaseController
{
    protected $GenresModel;

    public function __construct()
    {
        $this->GenresModel = new GenresModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Home | Wp Khabib',
            'genres' => $this->GenresModel->orderBy('name ASC')->findAll(),
        ];
        return view('index', $data);
    }

    public function nama()
    {
        // echo "hallo $this->nama";
        // $this->nama didapat dari basecontroller sehingga bisa di jalankan di semua controller
    }
}
