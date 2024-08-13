<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $table = 'trips';
    protected $primaryKey = 'id';
    protected $fillable = ['destination', 'country', 'description', 'price', 'photo'];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}