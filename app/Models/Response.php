<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Response extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'responses';
    protected $fillable = ['name', 'intro', 'image', 'status', 'home', 'cod', 'email'];

}
