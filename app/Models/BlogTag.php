<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Blog;

class BlogTag extends Model
{
    use HasFactory;
    protected $fillable = ['blog_id', 'tag_id'];

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }

   
}
