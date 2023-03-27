<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAccountDetail extends Model
{
    use HasFactory;
    protected $table = 'vendor_account_details';
    protected $primaryKey = 'id';
    protected $timeStamp = true;
    protected $fillable = ['vendor_id','token','meter_no','account_no','password','account_no1','environment',
    'isActive','company_name','gst_no','pincode','contact_person','address_1','city_id','email_id','address_2',
    'state_id','phone','address_3','country_id','pickup_address',
    ];
}
