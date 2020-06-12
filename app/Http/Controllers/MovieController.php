<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Services\UpsetMovie;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Repositories\Interfaces\MoviesRepositoryInterface;

class MovieController extends Controller
{

    private $moviesRepository;

    public function __construct(MoviesRepositoryInterface $moviesRepository)
    {
        $this->moviesRepository = $moviesRepository;
    }
    

    public function index()
    {
        $sort  = (request()->has('sort')) ? request()->sort : 'title';
        return $this->moviesRepository->all($sort);
    }


    public function store(CreateMovieRequest $request, UpsetMovie $action)
    {
        $requestData = $request->validated();
        $image = ['image' => $request->file('image')->store('movies', 'public')];
        $data = array_replace($requestData, $image);
        $movie = $action->execute($data, new Movie);
        return response()->json(
            ['data' => [
                'type' => 'movie',
                'id' => $movie->id,
                'attributes' => [$movie]
            ]],
            201
        );
    }

    
    public function show(Movie $movie)
    {
        return response()->json(
            ['data' => [
                'type' => 'movie',
                'id' => $movie->id,
                'attributes' => [$movie]
            ]],
            200
        );
    }


    public function update(UpdateMovieRequest $request, Movie $movie, UpsetMovie $action)
    {

        if ($request->hasFile('image')) {
            $requestData = $request->validated();
            $image = ['image' => $request->file('image')->store('movies', 'public')];
            $data = array_replace($requestData, $image);
        } else {
            $data = $request->validated();
        }
        $movie = $action->execute($data, $movie);
        return response()->json(
            ['data' => [
                'type' => 'movie',
                'id' => $movie->id,
                'attributes' => [$movie]
            ]],
            200
        );
    }

   
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json([], 204);
    }


    public function remove(Movie $movie)
    {
        $toggle = ($movie->availability) ? false : true;
        $movie->update(['availability' => $toggle]);
        return response()->json(
            ['data' => [
                'type' => 'movie',
                'id' => $movie->id,
                'attributes' => [$movie]
            ]],
            200
        );
    }

    public function getMoviesByTitle()
    {
        $title = (request()->has('title')) ? request()->title : '' ;
        return $this->moviesRepository->getMoviesByTitle($title);
    }

    public function indexAdmin()
    {
        if (request()->has('filter')) {
            $data = $this->moviesRepository->allAdmin(request()->filter);
        }
        else{
            $sort  = (request()->has('sort')) ? request()->sort : 'title';
            $data = $this->moviesRepository->all($sort);
        }
        
        return $data;
    }
}
