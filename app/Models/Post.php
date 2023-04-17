<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = ['title', 'slug', 'intro', 'views', 'category_id', 'image', 'content', 'author', 'status', 'home', 'cod', 'meta_description', 'meta_key', 'meta_title','user_id', 'deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(
            Tag::class,
                'post_tags',
                'post_id',
                'tag_id'
            );
    }



    // public function hasPrevious()
    // {
    //     return self::where('id', '<', $this->id)->max('id');
    // }

    // public function getPrevious()
    // {
    //     $postID = $this->hasPrevious(); //ID
    //     return self::find($postID);
    // }

    // public function hasNext()
    // {
    //     return self::where('id', '>', $this->id)->min('id');
    // }

    // public function getNext()
    // {
    //     $postID = $this->hasNext();
    //     return self::find($postID);
    // }

}
