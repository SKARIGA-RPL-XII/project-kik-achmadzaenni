<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrBarang extends Model
{
    protected $table = 'trbarang';
    protected $primaryKey = 'brgid';
    public $timestamps = false;

    protected $fillable = [
        'brgnm',
        'barcode',
        'expired',
        'fileid',
        'qty',
        'price',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive',
    ];

    public static function datatable($userid)
    {
        $query = self::leftjoin('msfile', 'msfile.fileid', '=', 'trbarang.fileid')
            ->where('trbarang.isactive', 1)
            ->where('trbarang.createdby', $userid)
            ->select('msfile.filenm', 'msfile.exfilenm', 'trbarang.*');

        return $query;
    }
    public static function getBarang($id)
    {
        $query = self::leftjoin('msfile', 'msfile.fileid', '=', 'trbarang.fileid')
            ->where('trbarang.isactive', 1)
            ->where('trbarang.brgid', $id)
            ->select('msfile.filenm', 'msfile.exfilenm', 'trbarang.*')
            ->first();

        return $query;
    }
    public static function getBarangUser()
    {
        $query = self::leftjoin('msfile', 'msfile.fileid', '=', 'trbarang.fileid')
            ->leftjoin('mscontact', 'trbarang.createdby', '=', 'mscontact.userid')
            ->where('trbarang.isactive', 1)
            ->select('msfile.filenm', 'msfile.exfilenm', 'trbarang.*', 'mscontact.storenm')
            ->get();

        return $query;
    }
}
