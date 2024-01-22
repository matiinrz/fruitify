<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed plate
 * @property mixed image
 * @property mixed weight
 * @property mixed type
 * @property mixed egress_date
 * @property mixed user_id
 * @property mixed destination
 * @property mixed entry_date
 * @property mixed fruit_id
 * @property mixed destination_type
 * @property mixed origin
 * @property mixed city_id
 * @property mixed province_id
 * @property mixed stall_id
 * @property mixed hall_id
 * @property mixed price
 */
class Egress extends Model
{
    use HasFactory;

    protected $table = 'egress';

    protected $fillable = [
        'plate',
        'image',
        'weight',
        'type',
        'egress_date',
        'user_id',
        'destination'
    ];

    protected $casts = [
        'type' => 'array'
    ];

    public function fruit()
    {
        return $this->belongsTo(Fruit::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
