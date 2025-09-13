<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
   protected $fillable = [
        'Name',
        'email',
        'Debit',
        'Credit',
        'Phone',
    ];
}
