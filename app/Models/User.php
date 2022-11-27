<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;
    use HasFactory;
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
