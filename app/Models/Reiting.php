<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reiting extends Model
{
    use HasFactory;
    protected $table = 'reitings';
    protected $fillable = [
        'post_id',
        'reiting',
    ];
}
