<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'x_axis', 'y_axis', 'quantity_alert'];

    protected $casts = [
        'x_axis' => 'string',
        'y_axis' => 'string',
    ];
    
    public static $axisOptions = [
        'measures' => 'Measures',
        'units' => 'Units', 
        'brands' => 'Brands',
        'types' => 'Types',
        'sub_measures' => 'Sub Measures',
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function measures()
    {
        return $this->hasMany(Measure::class);
    }

    public function subMeasures()
    {
        return $this->hasMany(SubMeasure::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
