<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantImage extends Model
{
    use HasFactory;

    protected $fillable = ['variant_id', 'name'];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
