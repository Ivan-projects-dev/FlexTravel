<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'trip_id',
        'trip_date',
        'is_luxury',
        'card_number',
        'expire_date',
        'cvc',
    ];
    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = Crypt::encryptString($value);
    }
    public function setExpireDateAttribute($value)
    {
        $this->attributes['expire_date'] = Crypt::encryptString($value);
    }
    public function setCvcAttribute($value)
    {
        $this->attributes['cvc'] = Crypt::encryptString($value);
    }
    public function getCardNumberAttribute($value)
    {
        return Crypt::decryptString($value);
    }
    public function getExpireDateAttribute($value)
    {
        return Crypt::decryptString($value);
    }
    public function getCvcAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
