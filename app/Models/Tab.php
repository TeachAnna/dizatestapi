<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tab extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tabs';
    protected $fillable = ['title', 'content', 'status', 'home', 'cod'];

}
