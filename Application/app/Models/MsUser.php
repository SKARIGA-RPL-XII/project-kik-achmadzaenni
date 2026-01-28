<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsUser extends Model
{
    protected $table = 'msuser';
    protected $primaryKey = 'userid';
    public $timestamps = false;

    protected $fillable = [
        'usernm',
        'email',
        'pswd',
        'isactive',
        'roleid',
        'createddate',
        'createdby',
        'updatedate',
        'updatedby'
    ];

    protected $hidden = [
        'pswd'
    ];
}
