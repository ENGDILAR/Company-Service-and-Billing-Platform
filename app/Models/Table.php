<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'name',
        'total',
    ];
    public function rows()
    {
        return $this->hasMany(Row::class,'TableID');
    }

    
}
