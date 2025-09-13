<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;
   protected $fillable = [
        'debit',
        'credit',
        'Phone',
        'date',
        'statement',
        'detailes',
        'TableID'
    ];  

    public function Table()
    {
        return $this ->belongsTo(Table::class,'TableID');
    }
}
