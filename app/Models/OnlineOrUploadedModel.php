<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineOrUploadedModel extends Model
{
    use HasFactory;
    protected $table = 'onlineOrUpload';
    protected $fillable = ['depositor_id','method'];
}
