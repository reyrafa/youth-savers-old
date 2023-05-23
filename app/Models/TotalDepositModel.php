<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalDepositModel extends Model
{
    use HasFactory;

    protected $table = 'totalDeposit';
    protected $fillable = [
        'relationID', 'amount', 'validatedBy'
    ];
}
