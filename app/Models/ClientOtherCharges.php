<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientOtherCharges extends Model
{use SoftDeletes;

    use HasFactory;
    protected $table = 'client_other_charges';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = [
        'id','client_id','charge_type','type','amount_per','created_at','updated_at',
    ];
}
