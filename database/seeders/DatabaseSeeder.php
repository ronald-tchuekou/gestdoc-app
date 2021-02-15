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

        for($i=1; $i<=4; $i++){
            DB::table('personnes')->insert([
                [
                    'nom' => "NomPersonne$i",
                    'prenom' => "PrenomPersonne$i",
                    'sexe' => $i%2 == 0 ? 1 : 2,
                    'email' =>"presonne$i@gmail.com",
                    'telephone' => "55515".$i."51$i",
                    'cni' => '000000000000000',
                    'localisation' => 'Douala',
                    'status' => $i%2 == 0 ? 1 : 2,
                ]
            ]);
        }

        // Create 3 users.
        DB::table('users')->insert([
            [
                'personne_id' => 1,
                'login' =>  'admin',
                'password' => '$2y$10$N7WeIOY4WP6DCed9orp.Pu/9P1RZcciGcQHikTD7Dao3TIXSWSlIe',
                'role' => 2,
                'profile' => '/images/profiles/default_profile.png?h=100&w=100&fit=crop',
            ],
            [
                'personne_id' => 2,
                'login' =>  'root',
                'password' => '$2y$10$N7WeIOY4WP6DCed9orp.Pu/9P1RZcciGcQHikTD7Dao3TIXSWSlIe',
                'role' => 3,
                'profile' => '/images/profiles/default_profile.png?h=100&w=100&fit=crop',
            ],
            [
                'personne_id' => 3,
                'login' =>  'agent',
                'password' => '$2y$10$N7WeIOY4WP6DCed9orp.Pu/9P1RZcciGcQHikTD7Dao3TIXSWSlIe',
                'role' => 1,
                'profile' => '/images/profiles/default_profile.png?h=100&w=100&fit=crop',
            ],
            [
                'personne_id' => 4,
                'login' =>  'accueil',
                'password' => '$2y$10$N7WeIOY4WP6DCed9orp.Pu/9P1RZcciGcQHikTD7Dao3TIXSWSlIe',
                'role' => 4,
                'profile' => '/images/profiles/default_profile.png?h=100&w=100&fit=crop',
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
