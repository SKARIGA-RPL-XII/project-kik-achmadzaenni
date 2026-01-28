<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingRegistration extends Model
{
    protected $table = 'pending_registrations';
    protected $primaryKey = 'pendingid';
    public $timestamps = false;

    protected $fillable = [
        'usernm',
        'email',
        'pswd',
        'otp',
        'isactive',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby'
    ];
}
