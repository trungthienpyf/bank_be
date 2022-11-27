<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class, 'fromAcc','accountNumber');
    }
    public function userTo()
    {
        return $this->belongsTo(User::class, 'toAcc','accountNumber');
    }

}
