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

    public function getByCountry(int $limit_count = 5)
    {
         return $this->posts()->with('country')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
