<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralModel extends Model
{
    use HasFactory;
    protected $fillable =[
        'firstname',
        'lastname',
        'middlename',
        'branch_id',
        'branch_under_id',
        'depositor_id'
    ];
    protected $table ='referral';
}
