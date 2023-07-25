<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 */
class Hall extends Model
{
    use HasFactory;

    protected $table = 'halls';
    protected $fillable = ['name'];

}
