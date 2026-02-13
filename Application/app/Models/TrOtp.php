<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrOtp extends Model
{

    protected $table = 'trotp';
    protected $primaryKey = 'otpid';

    public $incrementing = true;
    protected $keyType = 'int';

    const CREATED_AT = 'createddate';
    const UPDATED_AT = 'updateddate';

    protected $fillable = [
        'otp',
        'userid',
        'isactive',
        'createdby',
        'updatedby',
        'isactive'
    ];
}