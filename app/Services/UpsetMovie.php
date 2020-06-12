<?php

namespace App\Services;

use App\Movie;

class UpsetMovie
{
    public function execute(array $data, Movie $movie) : Movie  
    {
        $movie->fill($data);
        $movie->save();
        return $movie;
    }
}
