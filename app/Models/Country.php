<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $primarykey='id';
    protected $table='country';
    public $timestamps=true;
    protected $fillable= ['id','country_name','country_code','isActive','created_at','updated_at','id'];
}
