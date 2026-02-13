<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsMenu extends Model
{
    protected $table = 'msmenu';
    protected $primaryKey = 'menuid';
    public $timestamps = false;

    protected $fillable = [
        'menunm',
        'parentid',
        'menulink',
        'menuicon',
        'sequence',
        'createddate',
        'createdby',
        'updatedate',
        'updatedby',
        'isactive'
    ];

    public static function getMainMenus($id)
    {
        $query = self::leftjoin('msusergroup', 'msmenu.menuid', '=', 'msusergroup.menuid')
            ->leftjoin('msrole', 'msusergroup.roleid', '=', 'msrole.roleid')
            ->leftjoin('msmenu as submenu', 'msmenu.parentid', '=', 'submenu.menuid')
            ->where('msmenu.isactive', 1)
            ->where('msusergroup.isactive', 1)
            ->where('msrole.isactive', 1)
            ->where('msrole.roleid', $id)
            ->select('msmenu.menuid', 'msmenu.parentid', 'msmenu.menunm', 'msmenu.menuicon', 'msmenu.menulink', 'msmenu.sequence', 'msrole.roleid', 'msrole.rolenm', 'submenu.menunm as submenunm')
            ->orderBy('msmenu.sequence', 'asc')
            ->get();

        return $query;
    }
    public static function getSubMenus()
    {
        $query = self::wherenull('parentid')
            ->wherenull('menulink')
            ->where('isactive', 1)
            ->select('msmenu.menuid', 'msmenu.menunm')
            ->get();
        return $query;
    }
}
