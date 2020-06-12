<?php

namespace App\Repositories\Interfaces;

use App\Movie;
use App\Services\UpsetMovie;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

interface MoviesRepositoryInterface 
{
    public function all($sort);

    public function getMoviesByTitle($title);

    public function allAdmin($filter);
}
