<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'sku',
        'price',
        'mrp',
        'qty',
        'length',
        'breadth',
        'width',
        'height',
        'weight',

    ];

    public function images()
    {
        return $this->hasMany(ProductAttrImages::class,'product_attr_id','id');
    }
    public function attribute_values()
    {
        return $this->hasMany(AttributeValue::class,'attribute_value_id','id');
    }
}
