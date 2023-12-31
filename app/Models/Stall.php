<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 */
class Stall extends Model
{
    use HasFactory;

    protected $table = 'stalls';
    protected $fillable = ['name'];

}
