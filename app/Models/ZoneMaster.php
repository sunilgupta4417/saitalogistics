<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneMaster extends Model
{
    use HasFactory;
    protected $table = 'zone_masters';
    protected $primaryKey = 'id';
    public $timestamps=true;
    protected $fillable= ['id','service_name','zone_name','zone_type','effctv_from','deleted_at','updated_at','created_at'];

}
