<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = ['title', 'intro', 'image', 'slug', 'status', 'cod', 'meta_description', 'meta_key', 'meta_title', 'parent_id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }
}
