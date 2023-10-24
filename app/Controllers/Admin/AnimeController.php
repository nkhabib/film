<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\GenresModel;
use App\Models\AnimesModel;

class AnimeController extends BaseController
{
    protected $AnimesModel;
    protected $GenresModel;
    protected $helpers = ['form', 'url'];
    public function __construct()
    {
        $this->AnimesModel = new AnimesModel();
        $this->GenresModel = new GenresModel();
    }

    public function insert()
    {
        $genres = $this->GenresModel->findAll();
        $data = [
            'title' => 'Input Anime',
            'genres' => $genres,
        ];
        return view('admin/InputAnime', $data);
    }

    public function save()
    {
        $rule = [
            'title' =>
            [
                'rules' => 'required|max_length[200]',
                'errors' => [
                    'required' => 'Judul Tidak Boleh Kosong',
                    'max_length' => 'Maksimal 200 Karakter'
                ]
            ],
            'sinopsis' =>
            [
                'rules' => 'required|min_length[50]|max_length[500]',
                'errors' => [
                    'required' => 'Sinopsis Tidak Boleh Kosong',
                    'min_length' => 'Minimal 50 Karakter',
                    'max_length' => 'Maksimal 500 Karakter'
                ]
            ],
            'cover' =>
            [
                'rules' => 'uploaded[cover]|max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/JPG,image/jpeg,image/JPEG,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih File',
                    'max_size' => 'Ukuran Maksimal 1 MB',
                    'is_image' => 'Upload hanya berupa gambar'
                ]
            ]
        ];

        if (!$this->validate($rule)) {
            // echo "Harus diisi";
            // echo "$validation->getErrors()";
            // $validation = \Config\Services::validation();
            return redirect()->back()->withInput();
        } else {
            // echo "ok";
            // $this->validator->getValidated();
            $genre = $this->request->getVar('genre');
            // dd($genre);
            $allGenre = implode(",", $genre);

            $slug = url_title($this->request->getVar('title'), '-', true);
            $file = $this->request->getFile('cover');
            $fileName = $file->getRandomName();
            $file->move('images', $fileName);

            $komik = [
                'title' => $this->request->getVar('title'),
                'slug' => "$slug" . uniqid(),
                'sinopsis' => $this->request->getVar('sinopsis'),
                'id_genre' => $allGenre,
                'image' => $fileName,
            ];

            // dd($komik);

            $save = $this->AnimesModel->save($komik);
            if ($save == true) {
                session()->setFlashdata('fineMessage', 'Anime Ditambahkan');
            } else {
                session()->setFlashdata('warnMessage', 'Anime Gagal Ditambahkan');
            }
            return redirect()->to('/animes');
        }
    }

    public function edit($slug)
    {
        $anime = $this->AnimesModel->where('slug', $slug)->first();
        $genres = $this->GenresModel->orderBy('name ASC')->findAll();
        $id_genre = explode(",", $anime['id_genre']);
        $data = [
            'title' => 'Edit Anime',
            'anime' => $anime,
            'genres' => $genres,
            'id_genre' => $id_genre,
        ];
        return view('admin/editAnime', $data);
    }

    function update($id)
    {
        $newTitle = $this->request->getVar('title');
        $db = $this->AnimesModel->find($id);
        $oldTitle = $db['title'];

        if ($newTitle == $oldTitle) {
            $ruleTitle = 'required|min_length[1]|max_length[200]';
            $slug = $db['slug'];
        } else {
            $ruleTitle = 'required|min_length[1]|max_length[200]|is_unique[animes.title]';
            $slug = url_title($newTitle, '-', true) . uniqid();
        }

        $rule = [
            'title' => [
                'rules' => $ruleTitle,
                'errors' => [
                    'required' => 'Judul Tidak Boleh Kosong',
                    'min_length' => 'Minimal 1 Karakter',
                    'max_length' => 'Maksimal 200 Karakter',
                    'is_unique' => 'Judul Sudah Ada !!'
                ]
            ],
            'sinopsis' => [
                'rules' => 'required|min_length[50]|max_length[500]',
                'errors' => [
                    'required' => 'Sinopsis Tidak Boleh Kosong',
                    'min_length' => 'Minimal 50 Karakter',
                    'max_length' => 'Maksimal 500 Karakter'
                ]
            ],
            'cover' => [
                'rules' => 'is_image[cover]|mime_in[cover,image/jpg,image/JPG,image/jpeg,image/JPEG,image/png,image/PNG]|max_size[cover,1024]',
                'errors' => [
                    'is_image' => 'File Hanya Boleh Berupa Gambar',
                    'mime_in' => 'File Tidak Sesuai',
                    'max_size' => 'Ukuran Maksimal 1 MB'
                ]
            ]
        ];

        if (!$this->validate($rule)) {
            return redirect()->back()->withInput();
        } else {
            $genres = $this->request->getVar('genre');
            $genreString = implode(",", $genres);
            $anime = [
                'id' => $id,
                'title' => $newTitle,
                'slug' => $slug,
                'sinopsis' => $this->request->getVar('sinopsis'),
                'id_genre' => $genreString,
            ];
            $file = $this->request->getFile('cover');
            if (!$file->getName() == "") {
                if ($db['image'] != "default.png") {
                    unlink('images/' . $db['image']);
                }

                $fileName = $file->getRandomName();
                $file->move('images', $fileName);
                $anime['image'] = $fileName;
            }

            $update = $this->AnimesModel->save($anime);
            if ($update) {
                session()->setFlashdata('fineMessage', 'Anime Diupdate');
            } else {
                session()->setFlashdata('warnMessage', 'Anime Gagal Diupdate');
            }
            return redirect()->to('/animes');
        }
    }

    function delete($id)
    {
        $anime = $this->AnimesModel->find($id);
        if ($anime['image'] != "default.png") {
            unlink('images/' . $anime['image']);
        }
        $del = $this->AnimesModel->delete($id);
        if ($del) {
            session()->setFlashdata('fineMessage', 'Anime Dihapus !!');
        } else {
            session()->setFlashdata('warnMessage', 'Animes Gagal Dihapus');
        }
        return redirect()->to('/animes');
    }
}
