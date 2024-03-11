<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'IDCardAddress',
        'IDCardRT',
        'IDCardRW',
        'IDCardKelurahan',
        'IDCardKecamatan',
        'IDCardCity',
        'CopyID',
        'DomicileCity',
        'DomicileKecamatan',
        'DomicileKelurahan',
        'DomicilePostalCode',
        'DomicileRW',
        'DomicileRT',
        'IDCardPostalCode',
        'ResidencyNStatus',
        'customer_id',
    ];
    public function customer()
    {
    	return $this->belongsTo('App\Models\Customer');
    }
}
