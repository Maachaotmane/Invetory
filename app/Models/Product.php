<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'fournisseur_id', 'unit_id', 'brand_id', 'type_id',
        'measure_id', 'sub_category_id', 'store_id', 'created_by', 'reference', 'name', 'description', 'sub_measure_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function measure()
    {
        return $this->belongsTo(Measure::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function subMeasure()
    {
        return $this->belongsTo(SubMeasure::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function isVariant()
    {
        return $this->variants->count() > 1;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');    }
}
