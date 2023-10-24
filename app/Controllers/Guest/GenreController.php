<?php

namespace App\Controllers\Guest;

use App\Controllers\BaseController;
use App\Models\Admin\GenresModel;
use App\Models\AnimesModel;

class GenreController extends BaseController
{
    protected $GenresModel;
    protected $AnimesModel;
    public function __construct()
    {
        $this->GenresModel = new GenresModel();
        $this->AnimesModel = new AnimesModel();
    }
    public function getGenre($id, $offset = 0)
    {
        $genreName = $this->GenresModel->select('name')->find($id);
        $genres = $this->GenresModel->orderBy('name ASC')->findAll();
        $animes = $this->AnimesModel->like('id_genre', "$id")->orderBy('title ASC')->findAll(100, $offset);
        $allAnimeGenre = $this->AnimesModel->like('id_genre', "$id")->orderBy('title ASC')->findAll();
        if (auth()->loggedIn()) {
            $status = "Login";
            $access = $this->userAcceess->getPermissions();
        } else {
            $status = "No";
            $access[0] = "Guest";
        }

        $no = 0;
        foreach ($animes as $anime) {
            $nameGenre = [];
            $idGenres = explode(",", $anime['id_genre']);
            foreach ($idGenres as $idGenre) {
                $dbGenre = $this->GenresModel->find($idGenre);
                array_push($nameGenre, $dbGenre['name']);
            }

            $animes[$no++]['id_genre'] = $nameGenre;
        }
        $data = [
            'total' => count($allAnimeGenre),
            'offset' => $offset,
            'id' => $id,
            'status' => $status,
            'access' => $access,
            'title' => "Genre " . $genreName['name'],
            'genres' => $genres,
            'animes' => $animes,
        ];

        return view('guest/animeGenre', $data);
    }

    public function rating($slug)
    {
        echo $slug;
    }
}
