<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, softDeletes;
    protected $table = "posts";

    protected $fillable = ['title', 'content','status','published_at','tags','meta'];

    protected $casts = [
        'published_at' => 'datetime', 
        'tags'=>'array',
        'meta'=>'meta'
    ];

    public function categories(){
        //tabla private post_categories
        return $this->belongsToMany(Category::class)->using(CategoryPost::class)->withTimestamps(); 
}
}
