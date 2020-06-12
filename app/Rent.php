<?php

namespace App;

use App\Penalty;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'user_id','movie_id','quantity','rented_at','returned'
    ];

    protected $hidden = [
        'id'
    ];

    public function penalty()
    {
        return $this->hasOne(Penalty::class);
    }

}
