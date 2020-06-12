<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'user_id','movie_id','quantity','rented_at','returned'
    ];

    protected $hidden = [
        'id'
    ];

}
