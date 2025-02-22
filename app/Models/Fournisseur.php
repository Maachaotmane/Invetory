<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $table = 'fournisseurs';
    protected $fillable = [
        'name', 'address', 'phone', 'email', 'city', 'country', 'created_by'
    ];
}
