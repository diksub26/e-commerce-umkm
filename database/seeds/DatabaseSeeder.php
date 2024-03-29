<?php

use App\Seeds\LaratrustSeeder;
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
        $this->call([
            Laravolt\Indonesia\Seeds\DatabaseSeeder::class,
            LaratrustSeeder::class
        ]);
    }
}
