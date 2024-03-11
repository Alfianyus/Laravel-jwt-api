<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'BankName',
        'BankOwner',
        'BankNumber',
        'BankCabang',
        'QuestionRDN',
        'customer_id',

    ];
    public function customer()
    {
    	return $this->belongsTo('App\Models\Customer');
    }
}
