<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;
use App\Models\BlogTag;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'slug', 'user_id', 'status'];

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function blogCategory(){
        return $this->hasMany(BlogCategory::class);
    }

    public function blogTag(){
        return $this->hasMany(BlogTag::class);
    }

}
