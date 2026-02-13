<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHistory extends Model
{
    protected $table = 'trhistroy';
    protected $primaryKey = 'hisid';
    public $timestamp = false;

    protected $fillable = [
        'kategoriid',
        'brgid',
        'blcid',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive'
    ];

    
}
