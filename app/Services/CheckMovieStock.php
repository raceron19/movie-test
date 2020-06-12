<?php

namespace App\Services;

use App\Movie;

class CheckMovieStock
{
    public function execute($movie_id, $quantity) : bool  
    {
        $movie = Movie::find($movie_id);
        $stockEnough = ($movie->stock >= $quantity) ? true : false ;
        return $stockEnough;
    }
}
