<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleManger extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $fillable= ['id','name','created_at','updated_at'];
}
