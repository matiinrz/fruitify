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
 */
class Egress extends Model
{
    use HasFactory;

    protected $table = 'exit';

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
}
