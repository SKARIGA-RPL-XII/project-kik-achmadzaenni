<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrBalance extends Model
{
    protected $table = 'trbalance';
    protected $primaryKey = 'blcid';
    public $timestamps = false;

    protected $fillable = [
        'userid',
        'balance',
        'income',
        'expense',
        'status',
        'paytype',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive',
    ];

    public static function totalSaldo($userid)
    {
        $income = self::where('userid', $userid)->where('status', 1)->sum('income');
        $expense = self::where('userid', $userid)->where('status', 1)->sum('expense');
        return $income - $expense;
    }
    public static function getDataBalance($userid)
    {
        $query = self::leftjoin('msuser', 'msuser.userid', '=', 'trbalance.userid')
            ->leftjoin('trhistory', 'trhistory.blcid', '=', 'trbalance.blcid')
            ->leftjoin('trbarang', 'trbarang.brgid', '=', 'trhistory.brgid')
            ->where('trbalance.status', 1)
            ->where('trbalance.userid', $userid)
            ->select('msuser.*', 'trbalance.*', 'trhistory.*', 'trbarang.*')
            ->first();

        return $query;
    }
}
