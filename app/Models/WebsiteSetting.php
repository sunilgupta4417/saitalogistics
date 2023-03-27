<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;
    protected $table = 'website_settings';
    protected $primaryKey = 'id';
    protected $timeStamps = true;
    protected $fillable = ['id','data_key','data_value','data_extra1','data_extra2','created_at','updated_at'];
}
