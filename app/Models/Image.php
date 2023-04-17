<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'images';

    protected $fillable = ['path', 'url', 'desk_id', 'prev_url'];


    public function desk()
    {
        return $this->belongsTo(Desk::class);
    }
}
