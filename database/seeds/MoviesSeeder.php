<?php

use App\Movie;
use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Movie::create([
                'title' => 'movie '.$i,
                'description' => 'this is the movie #'.$i.' and this is the description',
                'image' => null,
                'stock' => rand(1,20),
                'rent_price' => round((rand(50,150)/7), 2),
                'sale_price' => round((rand(50,150)/7), 2),
            ]);
        }
    }
}
