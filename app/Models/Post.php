<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    function rel_to_cat(){
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
    function rel_to_tag(){
        return $this->belongsTo(tag::class, 'tag');
    }
    function rel_to_user(){
        return $this->belongsTo(User::class, 'author_id');
    }
}
