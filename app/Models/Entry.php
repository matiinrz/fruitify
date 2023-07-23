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
}
