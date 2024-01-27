<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        ];
    
    public function posts()
    {
    return $this->hasMany(Post::class);  
    }
    
    // public function getByRestaurant(int $limit_count = 5)
    // {
    //  return $this->posts()->with('restaurant')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    // }
    
    public function getByRestaurant(int $limit_count = 5, string $sort)
    {
        if($sort === 'like'){
            return $this->posts()->with('restaurant')->withCount('likes')->orderByDesc('likes_count')->paginate($limit_count);
        }
        else if($sort === 'date'){
            return $this->posts()->with('restaurant')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        }
        else
        {
            return $this->posts()->with('restaurant')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        }
    }
}
