<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

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

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}
