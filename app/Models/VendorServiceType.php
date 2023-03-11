<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorServiceType extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $timeStamp = true;
    protected $guarded = [];
}
