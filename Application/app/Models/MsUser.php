<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laragear\WebAuthn\Contracts\WebAuthnAuthenticatable;
use Laragear\WebAuthn\WebAuthnAuthentication;

class MsUser extends Authenticatable implements WebAuthnAuthenticatable
{
    use WebAuthnAuthentication;
    protected $table = 'msuser';
    protected $primaryKey = 'userid';
    public $timestamps = false;

    protected $fillable = [
        'usernm',
        'email',
        'pswd',
        'storenm',
        'roleid',
        'createddate',
        'createdby',
        'updatedate',
        'updatedby',
        'isactive',
    ];

    protected $hidden = [
        'pswd'
    ];

    public static function getprofile($userid)
    {
        $query = self::leftjoin('mscontact', 'mscontact.userid', '=', 'msuser.userid')
        ->leftjoin('msrole', 'msrole.roleid', '=', 'msuser.roleid')
            ->leftjoin('msfile', 'msfile.fileid', '=', 'msuser.fileid')
            ->where('msuser.userid', $userid)
            ->select('msuser.*', 'mscontact.*', 'msfile.*', 'msrole.*')
            // ->select('msuser.userid', 'msuser.roleid', 'msuser.usernm', 'msuser.pswd', 'msuser.email', 'mscontact.phone', 'mscontact.address', 'mscontact.storenm', 'msfile.filenm', 'msfile.exfilenm', 'msfile.format', 'msfile.size', 'msrole.rolenm')
            ->first();

        return $query;
    }
    public static function datatable()
    {
        $query =  self::leftjoin('mscontact', 'mscontact.userid', '=', 'msuser.userid')
        ->leftjoin('msrole', 'msrole.roleid', '=', 'msuser.roleid')
            ->leftjoin('msfile', 'msfile.fileid', '=', 'msuser.fileid')
            ->select('msuser.*', 'mscontact.*', 'msfile.*', 'msrole.*');
            // ->select('msuser.userid', 'msuser.roleid', 'msuser.usernm', 'msuser.pswd', 'msuser.email', 'mscontact.phone', 'mscontact.address', 'mscontact.storenm', 'msfile.filenm', 'msfile.exfilenm', 'msfile.format', 'msfile.size', 'msrole.rolenm')
            // ->first();
            
        return $query;
    }
}
