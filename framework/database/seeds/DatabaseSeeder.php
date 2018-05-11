<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
       // factory(App\ProprietaireModel::class, 50)->create();
       for ($i = 0; $i <= 20; $i++) {
                DB::table('proprietaire')->insert([
                    'nom' => str_random(10),
                    'prenom' => str_random(10),
                    'titre' => str_random(10),
                ]);
       }

    }
}
