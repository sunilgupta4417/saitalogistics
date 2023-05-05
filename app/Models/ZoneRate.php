<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneRate extends Model
{
    use HasFactory;
    protected $table = 'zone_rates';
    protected $primaryKey = 'id';
    public $timestamps=true;
    protected $guarded = [];  
    protected $fillable = ['weight', 'package_type', 'carrier_type', 'rate'];

}
