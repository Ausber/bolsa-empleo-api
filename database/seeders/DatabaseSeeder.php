<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(50)->create();
        \App\Models\Oferta::factory(9)->create();
         \App\Models\OfertaUsuario::factory(50)->create();
    }
}
