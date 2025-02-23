<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'name', 
        'address', 
        'phone', 
        'email', 
        'credit_limit', 
        'total_due_amount', 
        'city', 
        'country', 
        'created_by'
    ];
}
