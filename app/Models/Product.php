<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'keywords',
        'item_code',
        'description',
        'category_id',
        'brand_id',
        'tax_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function tax(): BelongsTo
    {
        return $this->belongsTo(Tax::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class)->with('attribute_values');
    }

    public function productAttrs(): HasMany
    {
        return $this->hasMany(ProductAttr::class,'product_id','id')->with('images');
    }

    // public function images(): HasMany
    // {
    //     return $this->hasMany(ProductAttrImages::class);
    // }
}
