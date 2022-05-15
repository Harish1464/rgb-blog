<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Blog;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = ['blog_id', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }


}
