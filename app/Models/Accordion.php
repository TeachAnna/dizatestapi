<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accordion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'accordions';
    protected $fillable = ['title', 'intro', 'image', 'status', 'home', 'cod'];

}
