<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TBgVendor extends Model
{
    protected $table = 't_bgvendor';
    protected $fillable = [
        'login', 'password', 'companyid', 'vendorname', 'logo', 'status', 'role'
    ];
}
