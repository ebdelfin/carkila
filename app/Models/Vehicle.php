<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'make',
        'model',
        'year',
        'type',
        'color',
        'seating_capacity',
        'engine_number',
        'chassis_number',
        'plate_number',
        'rental_rate',
        'notes'
    ];





    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function image(){
        return $this->belongsTo('App\Models\Image');
    }

    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }
}
