<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\GenresModel;

class GenreController extends BaseController
{
    protected $GenresModel;
    public function __construct()
    {
        $this->GenresModel = new GenresModel();
    }

    public function genres()
    {
        $data = [
            'title' => 'All Genres',
            'genres' => $this->GenresModel->orderBy('name ASC')->findAll(),
        ];
        return view('admin/genres', $data);
    }

    public function insert()
    {
        $data = [
            'title' => 'Add Genres',
            'genres' => $this->GenresModel->orderBy('name ASC')->findAll(),
        ];
        return view('admin/addGenre', $data);
    }

    public function save()
    {
        $rules = [
            'genre' => [
                'rules' => 'required|min_length[1]|max_length[100]|is_unique[genres.name]',
                'errors' => [
                    'required' => 'Genre Tidak Boleh Kosong',
                    'min_length' => 'Minimal 1 Karakter',
                    'max_length' => 'Maksimal 100 Karakter',
                    'is_unique' => 'Genre Sudah Ada',
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }
        $genre = $this->request->getVar('genre');
        $data = [
            'name' => $genre,
        ];
        $save = $this->GenresModel->save($data);
        if ($save) {
            session()->setFlashdata('fineMessage', 'Genre Disimpan');
        } else {
            session()->setFlashdata('warnMessage', 'Genre Gagal Disimpan');
        }
        return redirect()->to('/genres');
    }
    
    function edit($id)
    {
        $login = auth()->loggedIn();
        $access = $this->userAcceess->getPermissions();
        if ($login == true and $access[0] == "admin.access") {
            $genre = $this->GenresModel->find($id);
            $data = [
                'title' => 'Edit Genre',
                'genre' => $genre,
                'genres' => $this->GenresModel->orderBy('name ASC')->findAll(),
            ];
            return view('admin/editGenre', $data);
        } else {
            return redirect()->to(base_url("/logout"));
        }
    }

    function update($id)
    {
        echo $id;
        $data = [
            'id' => $id,
            'name' => $this->request->getVar('genre'),
        ];

        $update = $this->GenresModel->save($data);
        if ($update) {
            session()->setFlashdata('fineMessage', 'Genre Diupdate');
        } else {
            session()->setFlashdata('warnMessage', 'Genre Gagal Diupdate');
        }
        return redirect()->to('/genres');
    }

    function delete($id)
    {
        $delete = $this->GenresModel->delete($id);
        if ($delete) {
            session()->setFlashdata('fineMessage', 'Genre Dihapus!');
        } else {
            session()->setFlashdata('warnMessage', 'Genre Gagal Dihapus');
        }
        return redirect()->to('/genres');
    }
}
