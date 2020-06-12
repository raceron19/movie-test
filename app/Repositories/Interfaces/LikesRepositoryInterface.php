<?php

namespace App\Repositories\Interfaces;

use App\Like;



interface LikesRepositoryInterface 
{
    public function getLike($movie_id);

    public function saveLike(Like $like, $newLikeValue, $movie_id);
}
