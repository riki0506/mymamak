<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function country()
{
    return $this->belongsTo(Country::class);
}

    public function dish()
{
    return $this->belongsTo(Dish::class);
}

    public function restaurant()
{
    return $this->belongsTo(Restaurant::class);
}

}
