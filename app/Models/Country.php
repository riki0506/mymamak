<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        ];
    
    public function posts()
    {
    return $this->hasMany(Post::class);  
    }

    public function getByCountry(int $limit_count = 5, string $sort)
    {
        if($sort === 'like'){
            return $this->posts()->with('country')->withCount('likes')->orderByDesc('likes_count')->paginate($limit_count);
        }
        else if($sort === 'date'){
            return $this->posts()->with('country')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        }
        else
        {
            return $this->posts()->with('country')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        }
    }
    
    // public function getPaginateByLimit(int $limit_count = 5, $sort = 'updated_at')
    // {
    // return $this->posts()
    //     ->with(['user', 'country', 'restaurant', 'dish'])
    //     ->orderBy($sort, 'DESC')
    //     ->paginate($limit_count);
    // }

}