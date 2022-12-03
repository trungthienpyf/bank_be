<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use HasApiTokens;
    protected $guarded = [];

    public function paymentsTo()
    {
        return $this->hasMany(Payment::class, 'fromAcc', 'accountNumber');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'toAcc', 'toAcc');
    }
    public function allPayments() {
        return $this->paymentsTo->merge($this->payments);
    }
}
