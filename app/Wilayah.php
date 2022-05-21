<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah';
	// protected $primaryKey = 'KODE_KELURAHAN';
    protected $fillable = [
        'KODEPROV',
        'PROVINSI',
        'KODEKEC',
        'KECAMATAN',
        'KODEKAB',
        'KABUPATEN',
        'KODEKEL',
        'KELURAHAN',
    ];
    public $timestamps = false;
}
