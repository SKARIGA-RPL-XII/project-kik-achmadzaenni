<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsKategori extends Model
{
    protected $table = 'mskategori';
    protected $primaryKey = 'kategoriid';
    public $timestamps = false;

    protected $fillable = [
        'kategorinm',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive',
    ];
}
