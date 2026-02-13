<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsFile extends Model
{
    protected $table = 'msfile';
    protected $primaryKey = 'fileid';
    public $timestamps = false;

    protected $fillable = [
        'filenm',
        'exfilenm',
        'createddate',
        'createdby',
        'updatedate',
        'updatedby',
        'isactive'
    ];
}
