<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsContact extends Model
{
    protected $table = 'mscontact';
    protected $primaryKey = 'userdtid';
    public $timestamps = false;

    protected $fillable = [
        'userid',
        'phone',
        'adrress',
        'storenm',
        'createddate',
        'createdby',
        'updatedate',
        'updatedby',
        'isactive,'
    ];
}
