<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerJobs extends Model
{
    use HasFactory;

    protected $fillable = [
        'Occupation',
        'Position',
        'NatureOfBusiness',
        'CompanyName',
        'CompanyAddress',
        'CompanyCity',
        'CompanyPostalCode',
        'IncomePerAnnum',
        'FundSource',
        'QuestionNPWP',
        'NPWPNumber',
        'NPWPReason',
        'PositionText',
        'NatureOfBusinessText',
        'customer_id',
    ];
    public function customer()
    {
    	return $this->belongsTo('App\Models\Customer');
    }
}
