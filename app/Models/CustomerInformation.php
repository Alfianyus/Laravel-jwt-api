<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInformation extends Model
{
    use HasFactory;

    protected $fillable = [
            'IDCardNumber',
            'FirstName',
            'BirthPlace',
            'BirthDate',
            'Sex',
            'MaritalStatus',
            'MotherName',
            'Religion',
            'Email',
            'MobilePhone',
            'Education',
            'InvestmentObjectives',
            'KTPBase64',
            'TandaTanganBase64',
            'SelfieBase64',
            'ContactPersonMobilePhone',
            'ContactPersonRelation',
            'ContactPersonName',
            'ContactPersonHomePhone',
            'ContactPersonAddress',         
            'customer_id',
    ];
    public function customer()
    {
    	return $this->belongsTo('App\Models\Customer');
    }
}
