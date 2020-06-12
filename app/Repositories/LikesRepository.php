<?php

namespace App\Repositories;


use App\Like;
use App\Repositories\Interfaces\LikesRepositoryInterface;

class LikesRepository implements LikesRepositoryInterface
{
    public function getLike($movie_id)
    {
        return Like::firstWhere([
            ['user_id', auth()->user()->id],
            ['movie_id',$movie_id]
        ]);;
    }

    public function saveLike(Like $like, $newLikeValue, $movie_id)
    {
        $like->like = $newLikeValue;
        $like->user_id = auth()->user()->id;
        $like->movie_id = $movie_id;
        $like->save();
        return $like;
    }

    
}
