<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientContactPerson extends Model
{use SoftDeletes;
    use HasFactory;
    protected $table = 'client_contact_people';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = [
        'id','client_id','contact_person_name','mobile_no','email_id','created_at','updated_at',
    ];
}
