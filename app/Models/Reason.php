<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;
    protected $primarykey='id';
    protected $table='reason';
    public $timestamps=true;
    protected $fillable= ['id','reason_text','reason_code','isActive','created_by','created_at','updated_at'];
}
