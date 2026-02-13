<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsUserGroup extends Model
{
    protected $table = 'msusergroup';
    protected $primaryKey = 'groupid';
    public $timestamps = false;

    protected $fillable = [
        'roleid',
        'menuid',
        'userid',
        'createddate',
        'createdby',
        'updatedate',
        'updatedby',
        'isactive'
    ];

    public static function datatable()
    {
        $query = self::leftjoin('msmenu', 'msusergroup.menuid', '=', 'msmenu.menuid')
            ->leftjoin('msrole', 'msusergroup.roleid', '=', 'msrole.roleid')
            ->leftjoin('msuser', 'msusergroup.userid', '=', 'msuser.userid')
            ->leftjoin('msmenu as submenu', 'msmenu.parentid', '=', 'submenu.menuid')
            ->select('msmenu.*', 'msrole.*', 'msuser.*', 'msusergroup.roleid as roleids', 'submenu.menunm as submenunm');

        return $query;
    }
    public static function getUserMenus($id)
    {
        $query = self::leftjoin('msmenu', 'msusergroup.menuid', '=', 'msmenu.menuid')
            ->leftjoin('msrole', 'msusergroup.roleid', '=', 'msrole.roleid')
            ->leftjoin('msuser', 'msusergroup.userid', '=', 'msuser.userid')
            ->leftjoin('msmenu as submenu', 'msmenu.parentid', '=', 'submenu.menuid')
            ->where('msmenu.menuid', $id)
            ->select('msmenu.*', 'msrole.*', 'msuser.*', 'submenu.menunm as submenunm')
            ->first();
        return $query;
    }
}
