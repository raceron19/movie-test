<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id','movie_id','quantity','sold_at'
    ];

    protected $hidden = [
        'id'
    ];

}
