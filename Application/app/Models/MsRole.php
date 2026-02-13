<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsRole extends Model
{
    protected $table = 'msrole';
    protected $primaryKey = 'roleid';
    public $timestamps = false;

    protected $fillable = [
        'rolenm',
        'createddate',
        'createdby',
        'updatedate',
        'updatedby',
        'isactive'
    ];

   public static function getRoleList()
{
    return self::select('roleid', 'rolenm')
        ->where('isactive', 1)
        ->get();
}
}
