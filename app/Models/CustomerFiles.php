<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFiles extends Model
{
    use HasFactory;
    protected $fillable= [
        'FilenameTandaTangan',
        'FilenameSelfie',
        'FilenameKTP',
        'customer_id',
    ];
}
