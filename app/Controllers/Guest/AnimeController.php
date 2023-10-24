<?php

namespace App\Controllers\Guest;

use App\Controllers\BaseController;
use App\Models\Admin\GenresModel;
use App\Models\AnimesModel;

class AnimeController extends BaseController
{
    protected $GenresModel;
    protected $AnimesModel;
    public function __construct()
    {
        $this->GenresModel = new GenresModel();
        $this->AnimesModel = new AnimesModel();
    }
    public function animes($offset = 0)
    {
        if (auth()->loggedIn()) {
            $status = "Login";
            $access = $this->userAcceess->getPermissions();
        } else {
            $status = "No";
            $access[0] = "Guest";
        }
        $limit = 500;
        $animes = $this->AnimesModel->orderBy('title ASC')->findAll($limit, $offset);
        $total =  count($this->AnimesModel->orderBy('title ASC')->findAll());
        // if ($total >= 500) {
        //     echo "wow";
        // }
        // ubah isi array jadi dibawah ini
        // $animes[0]['id_genre'] = "ada ada aja";

        // manipulasi array
        $no = 0;
        foreach ($animes as $anime) {
            // echo $anime['id_genre'];
            // echo "<br>";
            $idGenres = explode(",", $anime['id_genre']);
            $nameGenre = [];
            foreach ($idGenres as $idGenre) {
                $genre = $this->GenresModel->find($idGenre);
                array_push($nameGenre, $genre['name']);
            }

            $animes[$no++]['id_genre'] = $nameGenre;
            // var_dump($nameGenre);
            // echo "<br>";
        }
        // dd($animes);
        // die();
        $data = [
            'status' => $status,
            'access' => $access,
            'offset' => $offset,
            'total' => $total,
            'animes' => $animes,
            'title' => 'All Animes',
            'genres' => $this->GenresModel->orderBy('name ASC')->findAll(),
        ];
        return view('guest/AllAnime', $data);
    }

    public function detail($slug)
    {
        $detail = $this->AnimesModel->where('slug', $slug)->first();
        $data = [
            'title' => 'Detail Anime',
            'animes' => $detail,
            'genres' => $this->GenresModel->orderBy('name ASC')->findAll(),
        ];
        return view('guest/detailAnime', $data);
    }
}
