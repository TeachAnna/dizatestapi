<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desk extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'desks';

    protected $fillable = ['title'];

    public function images() {
        return $this->hasMany(Image::class);
    }
}
