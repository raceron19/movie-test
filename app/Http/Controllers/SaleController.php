<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Services\CheckMovieStock;
use App\Http\Requests\SaleRentRequest;
use App\Services\UpdateMovieStock;

class SaleController extends Controller
{
    public function sale(SaleRentRequest $request, CheckMovieStock $action, UpdateMovieStock $updateStock)
    {
        $stockEnough = $action->execute($request->movie_id, $request->quantity);
        if ($stockEnough) {
            $data = array_replace($request->validated(), ['user_id' => auth()->user()->id]);
            $sale = Sale::create($data);
            $updateStock->execute($data['movie_id'], $data['quantity'], false);
            $response = ['data' => [
                'type' => 'sale',
                'id' => $sale->id,
                'attributes' => [$sale]
            ]];
        }
        else{
            $response = ['error' => [
                    'status' => '202',
                    'title' => 'Don\'t stock enough',
                    'detail' => 'The quantity of selling movies it\'s bigger than the stock.'
            ]];
        }
        return response()->json($response,200);
    }
}
