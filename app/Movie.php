<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'stock', 'rent_price', 'sale_price', 'availability'
    ];

    protected $hidden = [
        'id'
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            $image = asset('/storage/'.$value);
        }
        else{
            $image = 'https://images.designtrends.com/wp-content/uploads/2016/04/01102639/Packed-Products-Icon.png';
        }
        return ($image);
    }

    
}
