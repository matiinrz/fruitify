<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed plate
 * @property mixed image
 * @property mixed weight
 * @property mixed type
 * @property mixed entry_date
 * @property mixed user_id
 * @property false|mixed|string picture
 * @property mixed fruit_id
 * @property mixed origin
 * @property mixed destination_type
 * @property mixed destination
 * @property mixed province_id
 * @property mixed city_id
 * @property mixed stall_id
 * @property mixed hall_id
 * @property false|mixed|string plate_image
 */
class Entry extends Model
{
    use HasFactory;

    protected $table = 'entry';
    protected $fillable = [
        'plate',
        'picture',
        'weight',
        'type',
        'egress_date',
        'user_id'
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
