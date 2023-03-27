<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientMaster extends Model
{
    use HasFactory;
    protected $table= "client_masters";
    protected $primaryKey = 'id';
    public $timeStamps = true;
    protected $fillable = [ 
        'id','client_code','client_name', 'sales_person', 'client',
        'address1', 'state_id', 'email_id', 'address2', 'country_id', 'pan',
        'pincode','mobile_no','gstin','city_id','office_phone_no','iec','aadhaar_no',
        'bill_payment_type','bill_credit_amount','bill_isActive','bill_tax_applicable','bill_vol','bill_currency',
        'bill_self_service','bill_mail_notification','bill_fuel_applicable','bill_enable_fedex_tpc',
        'bill_generate_label','bill_no_invoice_amount',
    ];
}

