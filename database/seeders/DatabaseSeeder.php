<?php

namespace Database\Seeders;

use App\Models\Personne;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Create 10 Personne.
        Personne::factory(3)->create();

        // Create 3 users.
        DB::table('users')->insert([
            [
                'personne_id' => 1,
                'login' =>  'admin',
                'password' => '$2y$10$N7WeIOY4WP6DCed9orp.Pu/9P1RZcciGcQHikTD7Dao3TIXSWSlIe',
                'role' => 2,
            ],
            [
                'personne_id' => 2,
                'login' =>  'root',
                'password' => '$2y$10$N7WeIOY4WP6DCed9orp.Pu/9P1RZcciGcQHikTD7Dao3TIXSWSlIe',
                'role' => 3,
            ],
            [
                'personne_id' => 3,
                'login' =>  'agent',
                'password' => '$2y$10$N7WeIOY4WP6DCed9orp.Pu/9P1RZcciGcQHikTD7Dao3TIXSWSlIe',
                'role' => 1,
            ]
        ]);

        // Categories.
        DB::table('categories')->insert([
            [
                'intitule' => 'Categorie 1',
            ],
            [
                'intitule' => 'Categorie 2',
            ],
            [
                'intitule' => 'Categorie 3',
            ],
            [
                'intitule' => 'Categorie 4',
            ],
            [
                'intitule' => 'Categorie 5',
            ]
        ]);

        // Services.
        DB::table('services')->insert([
            [
                'intitule' => 'Service 1',
            ],
            [
                'intitule' => 'Service 2',
            ],
            [
                'intitule' => 'Service 3',
            ],
            [
                'intitule' => 'Service 4',
            ],
            [
                'intitule' => 'Service 5',
            ]
        ]);
    }
}
