<?php

namespace App\Modules\Seller\Models;

use Illuminate\Database\Eloquent\Model;

class Users_Model extends Model {
    
    protected $table = "sellers";
    protected $fillable = [
        'fullname',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
}