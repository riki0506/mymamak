<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
        'country_id',
        'restaurant_id',
        'dish_id',
        'user_id',
        'image_url',
        ];

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

    public function getPaginateByLimit(int $limit_count = 5)
    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
    return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
