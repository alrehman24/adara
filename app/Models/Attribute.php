<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Readline\Hoa\FileLink;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];
}
