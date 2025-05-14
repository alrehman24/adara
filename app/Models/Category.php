<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $fillable = ['name','slug','parent_id'];



    public function attribute()
    {
        return $this->belongsToMany(Attribute::class, 'category_attribute');
    }
}
