<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Api\Posts;

class Follows extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_user_id',
        'following_user_id',
        'following_page_id',
    ];

    
//relation with post and following person 
    public function PersonPost(){
        return $this->hasMany(Posts::class,'user_id','following_user_id');
    }
}
