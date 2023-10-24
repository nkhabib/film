<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Animes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'           => 'VARCHAR',
                'constraint'     => 200,
            ],
            'slug' => [
                'type'           => 'VARCHAR',
                'constraint'     => 200,
            ],
            'sinopsis' => [
                'type' => 'TEXT',
            ],
            'id_genre' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'release_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'season' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('animes');
    }

    public function down()
    {
        $this->forge->dropTable('animes');
    }
}
