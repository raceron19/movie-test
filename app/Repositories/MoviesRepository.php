<?php

namespace App\Repositories;

use App\Movie;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Repositories\Interfaces\MoviesRepositoryInterface;
use App\Services\UpsetMovie;

class MoviesRepository implements MoviesRepositoryInterface
{
    public function all($sort)
    {
        if ($sort == 'title' || $sort == 'likes') {
            $data = Movie::where('availability',true)->orderBy($sort, 'asc')->paginate(10);
        }
        else{
            $data = ['data'=>[]];
        }
        return $data;
    }

    public function getMoviesByTitle($title)
    {
        if ($movies=Movie::where('title','like','%'.$title.'%')->paginate(10)) {
            $data = $movies;
        }
        else{
            $data = ['data' => []];
        }
        return response()->json($data,200);
    }

    public function allAdmin($filter)
    {
        if ($filter == true || $filter == false) {
            $flag = ($filter=='true') ? true : false ;
            $data = Movie::where('availability',$flag)->orderBy('title', 'asc')->paginate(10);
        }
        else{
            $data = ['data'=>[]];
        }
        return $data;
    }

    
}
