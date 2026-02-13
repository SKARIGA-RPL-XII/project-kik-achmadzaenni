<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrCart extends Model
{
    protected $table = 'trcart';
    protected $primaryKey = 'cartid';
    public $timestamps = false;

    protected $fillable = [
        'userid',
        'brgid',
        'qty',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive',
    ];

    public function barang()
    {
        return $this->belongsTo(TrBarang::class, 'brgid', 'brgid');
    }

    public static function item($userid, $brgid)
    {
        $query = self::where('userid', $userid)
            ->where('brgid', $brgid)
            ->where('isactive', 1)
            ->first();

        return $query;
    }

    public static function cartitem($userid, $cartid)
    {
        $query = self::where('cartid', $cartid)->where('userid', $userid)->where('isactive', 1)->first();
        return $query;
    }
    public static function totalcard($userid)
    {
        $query = self::where('userid', $userid)
            ->where('isactive', 1)
            ->sum('qty');

        return $query;
    }

    public static function getCartDetail($userid)
    {
        return self::join('trbarang', 'trcart.brgid', '=', 'trbarang.brgid')
            ->leftJoin('msfile', 'trbarang.fileid', '=', 'msfile.fileid')
            ->where('trcart.userid', $userid)
            ->where('trcart.isactive', 1)
            ->select(
                'trcart.cartid',
                'trcart.qty',
                'trbarang.brgid',
                'trbarang.brgnm',
                'trbarang.price',
                'msfile.exfilenm',
                'msfile.filenm'
            )
            ->get();
    }
}
