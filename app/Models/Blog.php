<?php

namespace App\Models;

use App\Models\User;
use App\Models\BlogComment;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    // protected $fillable = ['user_id', 'category_id','image','title','slug','description','status']; // this line is note included in the original code
    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }
}
