<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AnimesSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->sentence(3);
            $slug = url_title($name, '-', true);
            $data = [
                'title' => $name,
                'slug' => $slug,
                'sinopsis' => $faker->paragraph(),
                'id_genre' => "1,2,3,4",
                'image' => "default.png",
                'created_at' => Time::now(),
            ];
            $this->db->table('animes')->insert($data);
        }
    }
}
