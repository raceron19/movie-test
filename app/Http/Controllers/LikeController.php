<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use App\Http\Requests\LikeRequest;
use App\Repositories\Interfaces\LikesRepositoryInterface;

class LikeController extends Controller
{
    private $likesRepository;

    public function __construct(LikesRepositoryInterface $likesRepository)
    {
        $this->likesRepository = $likesRepository;
    }
    public function like(LikeRequest $request)
    {
        $likeExists = $this->likesRepository->getLike($request->movie_id);
        if ($likeExists) {
            $data = $this->likesRepository->saveLike($likeExists, !$likeExists->like, $request->movie_id);
        }
        else{
            $data = $this->likesRepository->saveLike(new Like, true, $request->movie_id);
        }
        return response()->json(
            ['data' => [
                'type' => 'like',
                'id' => $data->id,
                'attributes' => [$data]
            ]],
            200
        );
    }
}
