<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tags';
    protected $fillable = ['title', 'intro', 'image', 'slug', 'status', 'views', 'cod', 'meta_description', 'meta_key', 'meta_title'];

    public function posts() {
        return $this->belongsToMany(
            Post::class,
                'post_tags',
                'tag_id',
                'post_id'
            );
    }

}
