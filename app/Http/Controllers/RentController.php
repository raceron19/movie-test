<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnRentRequest;
use App\Rent;
use Illuminate\Http\Request;
use App\Services\CheckMovieStock;
use App\Services\UpdateMovieStock;
use App\Http\Requests\SaleRentRequest;

class RentController extends Controller
{
    public function rent(SaleRentRequest $request, CheckMovieStock $action, UpdateMovieStock $updateStock)
    {
        $stockEnough = $action->execute($request->movie_id, $request->quantity);
        if ($stockEnough) {
            $data = array_replace($request->validated(), ['user_id' => auth()->user()->id]);
            $rent = Rent::create($data);
            $updateStock->execute($data['movie_id'], $data['quantity'], false);
            $response = ['data' => [
                'type' => 'rent',
                'id' => $rent->id,
                'attributes' => [$rent]
            ]];
        }
        else{
            $response = ['error' => [
                    'status' => '202',
                    'title' => 'Don\'t stock enough',
                    'detail' => 'The quantity of renting movies it\'s bigger than the stock.'
            ]];
        }
        return response()->json($response,200);

    }

    public function returnRent(ReturnRentRequest $request, UpdateMovieStock $updateStock)
    {
        $rent = Rent::find($request->rent_id);
        $rent->update(['returned' => true]);
        $updateStock->execute($rent->movie_id, $rent->quantity, true);
        return response()->json(['data' => [
            'type' => 'rent',
            'id' => $rent->id,
            'attributes' => [$rent]
        ]],
        200);
    }
}
