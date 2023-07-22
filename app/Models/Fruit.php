<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property false|mixed|string image
 */
class Fruit extends Model
{
    use HasFactory;

    protected $table = 'fruit';
    protected $fillable = ['name', 'image'];

}
