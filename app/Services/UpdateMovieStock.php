<?php

namespace App\Services;

use App\Movie;

class UpdateMovieStock
{
    public function execute($movie_id, $quantity, $add) : Movie  
    {
        $movie = Movie::find($movie_id);
        if ($add) {
            $newStock = $movie->stock + $quantity;    
        }
        else{
            $newStock = $movie->stock - $quantity;
        }
        $movie->update(['stock' => $newStock]);
        return $movie;
    }
}
