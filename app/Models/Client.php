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
        'created_by',
        'I_F',
        'R_C',
        'I_C_E',
        'C_N_S_S',
        'C_I_N',
        'profile_image',
        'C_I_N_image'
    ];
}
